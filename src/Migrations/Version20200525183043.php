<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525183043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proprety ADD rooms INT NOT NULL, ADD surface INT NOT NULL, ADD bedrooms INT NOT NULL, ADD price INT NOT NULL, ADD floor INT NOT NULL, ADD city VARCHAR(50) NOT NULL, ADD heat INT NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD postal VARCHAR(255) NOT NULL, ADD sold TINYINT(1) DEFAULT \'0\' NOT NULL, ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proprety DROP rooms, DROP surface, DROP bedrooms, DROP price, DROP floor, DROP city, DROP heat, DROP adresse, DROP postal, DROP sold, DROP created_at');
    }
}
