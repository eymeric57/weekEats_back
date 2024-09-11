<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910095556 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C89065A00');
        $this->addSql('DROP INDEX IDX_9EF68E9C89065A00 ON meal');
        $this->addSql('ALTER TABLE meal DROP meal_ingredient_id');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA933FE08C');
        $this->addSql('DROP INDEX IDX_FCC3CEFA933FE08C ON meal_ingredient');
        $this->addSql('ALTER TABLE meal_ingredient CHANGE ingredient_id meal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('CREATE INDEX IDX_FCC3CEFA639666D6 ON meal_ingredient (meal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meal ADD meal_ingredient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C89065A00 FOREIGN KEY (meal_ingredient_id) REFERENCES meal_ingredient (id)');
        $this->addSql('CREATE INDEX IDX_9EF68E9C89065A00 ON meal (meal_ingredient_id)');
        $this->addSql('ALTER TABLE meal_ingredient DROP FOREIGN KEY FK_FCC3CEFA639666D6');
        $this->addSql('DROP INDEX IDX_FCC3CEFA639666D6 ON meal_ingredient');
        $this->addSql('ALTER TABLE meal_ingredient CHANGE meal_id ingredient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meal_ingredient ADD CONSTRAINT FK_FCC3CEFA933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('CREATE INDEX IDX_FCC3CEFA933FE08C ON meal_ingredient (ingredient_id)');
    }
}
