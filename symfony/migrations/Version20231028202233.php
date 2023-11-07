<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231028202233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `category` (id INT AUTO_INCREMENT NOT NULL, `order` INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_translations (object_id INT NOT NULL, translation_id INT NOT NULL, INDEX IDX_1C60F915232D562B (object_id), UNIQUE INDEX UNIQ_1C60F9159CAA2B25 (translation_id), PRIMARY KEY(object_id, translation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `category_translation` (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3F207044180C698BF396750 (locale, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `configuration` (id INT AUTO_INCREMENT NOT NULL, maintenance TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration_translations (object_id INT NOT NULL, translation_id INT NOT NULL, INDEX IDX_9802B4EB232D562B (object_id), UNIQUE INDEX UNIQ_9802B4EB9CAA2B25 (translation_id), PRIMARY KEY(object_id, translation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `configuration_translation` (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DFFE27174180C698BF396750 (locale, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `home` (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE home_translations (object_id INT NOT NULL, translation_id INT NOT NULL, INDEX IDX_CE672B97232D562B (object_id), UNIQUE INDEX UNIQ_CE672B979CAA2B25 (translation_id), PRIMARY KEY(object_id, translation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `home_translation` (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_9A578224180C698BF396750 (locale, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `project` (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, `order` INT DEFAULT NULL, `highlight` TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_2FB3D0EE12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_translations (object_id INT NOT NULL, translation_id INT NOT NULL, INDEX IDX_EC103EE4232D562B (object_id), UNIQUE INDEX UNIQ_EC103EE49CAA2B25 (translation_id), PRIMARY KEY(object_id, translation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_images (project_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_F7BB5520166D1F9C (project_id), UNIQUE INDEX UNIQ_F7BB55203DA5256D (image_id), PRIMARY KEY(project_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `project_image` (id INT AUTO_INCREMENT NOT NULL, `order` INT DEFAULT NULL, `image` LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `project_translation` (id INT AUTO_INCREMENT NOT NULL, slug LONGTEXT DEFAULT NULL, title LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7CA6B2944180C698BF396750 (locale, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_translations (object_id INT NOT NULL, translation_id INT NOT NULL, INDEX IDX_467BA685232D562B (object_id), UNIQUE INDEX UNIQ_467BA6859CAA2B25 (translation_id), PRIMARY KEY(object_id, translation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user_translation` (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D728CFA4180C698BF396750 (locale, id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_translations ADD CONSTRAINT FK_1C60F915232D562B FOREIGN KEY (object_id) REFERENCES `category` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_translations ADD CONSTRAINT FK_1C60F9159CAA2B25 FOREIGN KEY (translation_id) REFERENCES `category_translation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE configuration_translations ADD CONSTRAINT FK_9802B4EB232D562B FOREIGN KEY (object_id) REFERENCES `configuration` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE configuration_translations ADD CONSTRAINT FK_9802B4EB9CAA2B25 FOREIGN KEY (translation_id) REFERENCES `configuration_translation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE home_translations ADD CONSTRAINT FK_CE672B97232D562B FOREIGN KEY (object_id) REFERENCES `home` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE home_translations ADD CONSTRAINT FK_CE672B979CAA2B25 FOREIGN KEY (translation_id) REFERENCES `home_translation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `project` ADD CONSTRAINT FK_2FB3D0EE12469DE2 FOREIGN KEY (category_id) REFERENCES `category` (id)');
        $this->addSql('ALTER TABLE project_translations ADD CONSTRAINT FK_EC103EE4232D562B FOREIGN KEY (object_id) REFERENCES `project` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_translations ADD CONSTRAINT FK_EC103EE49CAA2B25 FOREIGN KEY (translation_id) REFERENCES `project_translation` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_images ADD CONSTRAINT FK_F7BB5520166D1F9C FOREIGN KEY (project_id) REFERENCES `project` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_images ADD CONSTRAINT FK_F7BB55203DA5256D FOREIGN KEY (image_id) REFERENCES `project_image` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_translations ADD CONSTRAINT FK_467BA685232D562B FOREIGN KEY (object_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_translations ADD CONSTRAINT FK_467BA6859CAA2B25 FOREIGN KEY (translation_id) REFERENCES `user_translation` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_translations DROP FOREIGN KEY FK_1C60F915232D562B');
        $this->addSql('ALTER TABLE category_translations DROP FOREIGN KEY FK_1C60F9159CAA2B25');
        $this->addSql('ALTER TABLE configuration_translations DROP FOREIGN KEY FK_9802B4EB232D562B');
        $this->addSql('ALTER TABLE configuration_translations DROP FOREIGN KEY FK_9802B4EB9CAA2B25');
        $this->addSql('ALTER TABLE home_translations DROP FOREIGN KEY FK_CE672B97232D562B');
        $this->addSql('ALTER TABLE home_translations DROP FOREIGN KEY FK_CE672B979CAA2B25');
        $this->addSql('ALTER TABLE `project` DROP FOREIGN KEY FK_2FB3D0EE12469DE2');
        $this->addSql('ALTER TABLE project_translations DROP FOREIGN KEY FK_EC103EE4232D562B');
        $this->addSql('ALTER TABLE project_translations DROP FOREIGN KEY FK_EC103EE49CAA2B25');
        $this->addSql('ALTER TABLE project_images DROP FOREIGN KEY FK_F7BB5520166D1F9C');
        $this->addSql('ALTER TABLE project_images DROP FOREIGN KEY FK_F7BB55203DA5256D');
        $this->addSql('ALTER TABLE user_translations DROP FOREIGN KEY FK_467BA685232D562B');
        $this->addSql('ALTER TABLE user_translations DROP FOREIGN KEY FK_467BA6859CAA2B25');
        $this->addSql('DROP TABLE `category`');
        $this->addSql('DROP TABLE category_translations');
        $this->addSql('DROP TABLE `category_translation`');
        $this->addSql('DROP TABLE `configuration`');
        $this->addSql('DROP TABLE configuration_translations');
        $this->addSql('DROP TABLE `configuration_translation`');
        $this->addSql('DROP TABLE `home`');
        $this->addSql('DROP TABLE home_translations');
        $this->addSql('DROP TABLE `home_translation`');
        $this->addSql('DROP TABLE `project`');
        $this->addSql('DROP TABLE project_translations');
        $this->addSql('DROP TABLE project_images');
        $this->addSql('DROP TABLE `project_image`');
        $this->addSql('DROP TABLE `project_translation`');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_translations');
        $this->addSql('DROP TABLE `user_translation`');
    }
}
