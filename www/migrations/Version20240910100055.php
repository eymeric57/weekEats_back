<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910100055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_ingredient ADD ingredient_measurement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFAFCF9F8B5 FOREIGN KEY (ingredient_measurement_id) REFERENCES ingredient_measurements (id)');
        $this->addSql('CREATE INDEX IDX_FCC3CEFAFCF9F8B5 ON meal_ingredient (ingredient_measurement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFAFCF9F8B5');
        $this->addSql('DROP INDEX IDX_FCC3CEFAFCF9F8B5 ON meal_ingredient');
        $this->addSql('ALTER TABLE meal_ingredient DROP ingredient_measurement_id');
    }
}
