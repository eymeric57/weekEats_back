<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240915072835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_6BAF787012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_measurements (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_FCF22AF4FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_9EF68E9CFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_planing (meal_id INT NOT NULL, planing_id INT NOT NULL, INDEX IDX_6784EEDD639666D6 (meal_id), INDEX IDX_6784EEDD5E544CE5 (planing_id), PRIMARY KEY(meal_id, planing_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_ingredient (id INT AUTO_INCREMENT NOT NULL, meal_id INT DEFAULT NULL, ingredient_measurement_id INT DEFAULT NULL, ingredient_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_FCC3CEFA639666D6 (meal_id), INDEX IDX_FCC3CEFAFCF9F8B5 (ingredient_measurement_id), INDEX IDX_FCC3CEFA933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planing (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, date DATE NOT NULL, note LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1E375CC4FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planing_type (planing_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_B9D015F95E544CE5 (planing_id), INDEX IDX_B9D015F9C54C8C93 (type_id), PRIMARY KEY(planing_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_item (id INT AUTO_INCREMENT NOT NULL, liste_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, buying TINYINT(1) NOT NULL, INDEX IDX_6612795FE85441D8 (liste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal_planing ADD CONSTRAINT FK_6784EEDD639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_planing ADD CONSTRAINT FK_6784EEDD5E544CE5 FOREIGN KEY (planing_id) REFERENCES planing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFAFCF9F8B5 FOREIGN KEY (ingredient_measurement_id) REFERENCES ingredient_measurements (id)');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE planing ADD CONSTRAINT FK_1E375CC4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE planing_type ADD CONSTRAINT FK_B9D015F95E544CE5 FOREIGN KEY (planing_id) REFERENCES planing (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE planing_type ADD CONSTRAINT FK_B9D015F9C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_item ADD CONSTRAINT FK_6612795FE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787012469DE2');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4FB88E14F');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CFB88E14F');
        $this->addSql('ALTER TABLE meal_planing DROP FOREIGN KEY FK_6784EEDD639666D6');
        $this->addSql('ALTER TABLE meal_planing DROP FOREIGN KEY FK_6784EEDD5E544CE5');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA639666D6');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFAFCF9F8B5');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA933FE08C');
        $this->addSql('ALTER TABLE planing DROP FOREIGN KEY FK_1E375CC4FB88E14F');
        $this->addSql('ALTER TABLE planing_type DROP FOREIGN KEY FK_B9D015F95E544CE5');
        $this->addSql('ALTER TABLE planing_type DROP FOREIGN KEY FK_B9D015F9C54C8C93');
        $this->addSql('ALTER TABLE shopping_item DROP FOREIGN KEY FK_6612795FE85441D8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE ingredient_measurements');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_planing');
        $this->addSql('DROP TABLE meal_ingredient');
        $this->addSql('DROP TABLE planing');
        $this->addSql('DROP TABLE planing_type');
        $this->addSql('DROP TABLE shopping_item');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
