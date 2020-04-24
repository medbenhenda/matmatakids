<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422225726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(16) NOT NULL, city VARCHAR(128) NOT NULL, country VARCHAR(128) NOT NULL, mobile VARCHAR(32) NOT NULL, email VARCHAR(128) NOT NULL, INDEX IDX_818CC9D4B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor_folder (sponsor_id INT NOT NULL, folder_id INT NOT NULL, INDEX IDX_5D090AA912F7FB51 (sponsor_id), INDEX IDX_5D090AA9162CB942 (folder_id), PRIMARY KEY(sponsor_id, folder_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sponsor_folder ADD CONSTRAINT FK_5D090AA912F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sponsor_folder ADD CONSTRAINT FK_5D090AA9162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sponsor_folder DROP FOREIGN KEY FK_5D090AA912F7FB51');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE sponsor_folder');
    }
}
