<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426020839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C1312F7FB51');
        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C13162CB942');
        $this->addSql('DROP INDEX IDX_99A24C1312F7FB51 ON proposing_transaction');
        $this->addSql('DROP INDEX IDX_99A24C13162CB942 ON proposing_transaction');
        $this->addSql('ALTER TABLE proposing_transaction ADD affectation_id INT NOT NULL, DROP folder_id, DROP sponsor_id');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C136D0ABA22 FOREIGN KEY (affectation_id) REFERENCES affectation (id)');
        $this->addSql('CREATE INDEX IDX_99A24C136D0ABA22 ON proposing_transaction (affectation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C136D0ABA22');
        $this->addSql('DROP INDEX IDX_99A24C136D0ABA22 ON proposing_transaction');
        $this->addSql('ALTER TABLE proposing_transaction ADD folder_id INT DEFAULT NULL, ADD sponsor_id INT DEFAULT NULL, DROP affectation_id');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C1312F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('CREATE INDEX IDX_99A24C1312F7FB51 ON proposing_transaction (sponsor_id)');
        $this->addSql('CREATE INDEX IDX_99A24C13162CB942 ON proposing_transaction (folder_id)');
    }
}
