<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425225520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proposing_transaction (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, sponsor_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, responsible_id INT DEFAULT NULL, transaction_date DATETIME NOT NULL, amount NUMERIC(7, 0) NOT NULL, month INT NOT NULL, year INT NOT NULL, recieved TINYINT(1) DEFAULT NULL, recieved_date DATETIME NOT NULL, INDEX IDX_99A24C13162CB942 (folder_id), INDEX IDX_99A24C1312F7FB51 (sponsor_id), INDEX IDX_99A24C13B03A8386 (created_by_id), INDEX IDX_99A24C13602AD315 (responsible_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C1312F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13602AD315 FOREIGN KEY (responsible_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE proposing_transaction');
    }
}
