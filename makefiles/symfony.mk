$(call check_defined, project_container_name)
$(call check_defined, docker_runner)
# ================================================================================
# If the first argument is one of the supported commands...
# ================================================================================
SUPPORTED_COMMANDS := build console install start stop restart state cc tests assets database database-drop database-test database-test-drop fixtures migrations composer-install composer-require composer-remove composer-update composer-dump composer-create mysql units behat gulp npm-install bower-install php-stan react-npm-install react-npm debug-container debug-config debug-router wait-for-host gen-ssl-certificate-auto
SUPPORTS_MAKE_ARGS := $(findstring $(firstword $(MAKECMDGOALS)), $(SUPPORTED_COMMANDS))
ifneq "$(SUPPORTS_MAKE_ARGS)" ""
  # use the rest as arguments for the command
  COMMAND_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))

  # Escape ":" to allow easier symfony commands, e.g.: make console debug:autowiring
  COMMAND_ARGS := $(subst :,\:,$(COMMAND_ARGS))
  # ...and turn them into do-nothing targets
  $(eval $(COMMAND_ARGS):;@:)
endif
# Define defaults variables
step ?= /////////////////
composer_default_options = --no-interaction

compose=docker-compose
RUNNER_DOCKER_EXEC=$(compose) exec $(docker_runner) sh -c
RUNNER_DOCKER_BASH=docker exec -it $(project_container_name)_$(docker_runner)_1 sh

#------------------------------------------------------------------------------------------------
# Project related commands
#------------------------------------------------------------------------------------------------
install-app: composer-install
install-db: database-drop database-create migrations-migrate fixtures

install: start install-app install-db

lint: phpstan php-cs-fixer-check syntax-check

restart: down start

stop: down

build:
	@$(compose) build

start:
	@$(compose) up -d

down:
	@$(compose) down

composer-clear-cache:
	@$(RUNNER_DOCKER_EXEC) 'composer clear-cache'

fixtures:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console doctrine:fixtures:load -n'

migrations-diff:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console doctrine:migration:diff'

database-drop:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console doctrine:database:drop --force'

database-create:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console doctrine:database:create'

migrations-migrate:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console doctrine:migration:migrate -n'

cc:
	@$(RUNNER_DOCKER_EXEC) 'php bin/console c:c'

yarn-install:
	@$(RUNNER_DOCKER_EXEC) 'yarn install'

yarn-build:
	@$(RUNNER_DOCKER_EXEC) 'yarn build'

yarn-watch:
	@$(RUNNER_DOCKER_EXEC) 'yarn watch'

phpstan:
	@$(RUNNER_DOCKER_EXEC) "php vendor/bin/phpstan analyse src"

php-cs-fixer-fix:
	@$(RUNNER_DOCKER_EXEC) "php vendor/bin/php-cs-fixer -vv fix src --diff"

php-cs-fixer-check:
	@$(RUNNER_DOCKER_EXEC) "php vendor/bin/php-cs-fixer -vv fix src --dry-run"

syntax-check:
	@$(RUNNER_DOCKER_EXEC) "find -L src -name '*.php' -print0 | xargs -0 -n 1 php -l"

units:
	@echo "$(step) Running unit tests $(step)"
	@echo $(COMMAND_ARGS)
	@$(RUNNER_DOCKER_EXEC) "php vendor/bin/phpunit --log-junit report.xml $(COMMAND_ARGS)"

composer-install:
	@$(RUNNER_DOCKER_EXEC) 'php -d memory_limit=-1 /usr/bin/composer install $(composer_options) $(composer_default_options) --prefer-dist $(COMMAND_ARGS)'

composer-update:
	@$(RUNNER_DOCKER_EXEC) 'php -d memory_limit=-1 /usr/bin/composer update $(composer_default_options) --prefer-dist $(COMMAND_ARGS)'

composer-require:
	@$(RUNNER_DOCKER_EXEC) 'php -d memory_limit=-1 /usr/bin/composer require $(composer_default_options) --prefer-dist $(COMMAND_ARGS)'

composer-remove:
	@$(RUNNER_DOCKER_EXEC) 'php -d memory_limit=-1 /usr/bin/composer remove $(composer_default_options) $(COMMAND_ARGS)'

composer-dump:
	@$(RUNNER_DOCKER_EXEC) 'php -d memory_limit=-1 /usr/bin/composer dump-autoload $(composer_options) $(COMMAND_ARGS)'

bash:
	$(RUNNER_DOCKER_BASH)
