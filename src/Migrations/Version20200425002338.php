<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425002338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE folder CHANGE affected affected TINYINT(1) DEFAULT \'0\', CHANGE status status TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE folder_item CHANGE handicapped handicapped TINYINT(1) DEFAULT NULL, CHANGE unhealthy unhealthy TINYINT(1) DEFAULT NULL, CHANGE orphan orphan TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE folder CHANGE affected affected TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE status status TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE folder_item CHANGE handicapped handicapped TINYINT(1) NOT NULL, CHANGE unhealthy unhealthy TINYINT(1) NOT NULL, CHANGE orphan orphan TINYINT(1) NOT NULL');
    }
}
