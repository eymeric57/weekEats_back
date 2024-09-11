<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910094225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_ingredient_ingredient DROP FOREIGN KEY FK_2C70B77A933FE08C');
        $this->addSql('ALTER TABLE meal_ingredient_ingredient DROP FOREIGN KEY FK_2C70B77A89065A00');
        $this->addSql('DROP TABLE meal_ingredient_ingredient');
        $this->addSql('ALTER TABLE meal_ingredient ADD ingredient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('CREATE INDEX IDX_FCC3CEFA933FE08C ON meal_ingredient (ingredient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meal_ingredient_ingredient (meal_ingredient_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_2C70B77A933FE08C (ingredient_id), INDEX IDX_2C70B77A89065A00 (meal_ingredient_id), PRIMARY KEY(meal_ingredient_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE meal_ingredient_ingredient ADD CONSTRAINT FK_2C70B77A933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_ingredient_ingredient ADD CONSTRAINT FK_2C70B77A89065A00 FOREIGN KEY (meal_ingredient_id) REFERENCES meal_ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA933FE08C');
        $this->addSql('DROP INDEX IDX_FCC3CEFA933FE08C ON meal_ingredient');
        $this->addSql('ALTER TABLE meal_ingredient DROP ingredient_id');
    }
}
