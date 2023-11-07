docker_app=php
compose=docker-compose
RUNNER_DOCKER_EXEC=$(compose) exec $(docker_app) sh -c

build:
	@$(compose) build --no-cache

start:
	@$(compose) up -d

up: start

down:
	@$(compose) down

stop: down

bash:
	$(compose) exec -it $(docker_app) sh
