<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231202213036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `role_play_adventure` (id INT AUTO_INCREMENT NOT NULL, `start_at` DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', `end_at` DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', `type` VARCHAR(255) DEFAULT NULL, `name` VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_play_adventures_characters (adventure_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_474B353F55CF40F9 (adventure_id), UNIQUE INDEX UNIQ_474B353F1136BE75 (character_id), PRIMARY KEY(adventure_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `role_play_character` (id INT AUTO_INCREMENT NOT NULL, `name` VARCHAR(255) NOT NULL, `level` INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_play_adventures_characters ADD CONSTRAINT FK_474B353F55CF40F9 FOREIGN KEY (adventure_id) REFERENCES `role_play_adventure` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_play_adventures_characters ADD CONSTRAINT FK_474B353F1136BE75 FOREIGN KEY (character_id) REFERENCES `role_play_character` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_play_adventures_characters DROP FOREIGN KEY FK_474B353F55CF40F9');
        $this->addSql('ALTER TABLE role_play_adventures_characters DROP FOREIGN KEY FK_474B353F1136BE75');
        $this->addSql('DROP TABLE `role_play_adventure`');
        $this->addSql('DROP TABLE role_play_adventures_characters');
        $this->addSql('DROP TABLE `role_play_character`');
    }
}
