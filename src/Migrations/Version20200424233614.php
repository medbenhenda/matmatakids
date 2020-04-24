<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424233614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE folder_item (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, first_name VARCHAR(128) NOT NULL, last_name VARCHAR(128) NOT NULL, birthdate DATE NOT NULL, handicapped TINYINT(1) NOT NULL, unhealthy TINYINT(1) NOT NULL, orphan TINYINT(1) NOT NULL, schoolboy TINYINT(1) DEFAULT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_684030B162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE folder_item ADD CONSTRAINT FK_684030B162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76ABEC3E2D');
        $this->addSql('DROP TABLE folder_item');
    }
}
