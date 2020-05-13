<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513011335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subvention (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, entreprise VARCHAR(255) NOT NULL, entreprise_address VARCHAR(255) NOT NULL, entreprise_email VARCHAR(128) DEFAULT NULL, entreprise_phone1 VARCHAR(32) DEFAULT NULL, entreprise_phone2 VARCHAR(32) DEFAULT NULL, subject VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, deposite_date DATE DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_CCB93936B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subvention ADD CONSTRAINT FK_CCB93936B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document ADD subvention_id INT DEFAULT NULL, ADD subvention_doc_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76FA9EDA4C FOREIGN KEY (subvention_id) REFERENCES subvention (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76B9EF52E9 FOREIGN KEY (subvention_doc_id) REFERENCES subvention (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76FA9EDA4C ON document (subvention_id)');
        $this->addSql('CREATE INDEX IDX_D8698A76B9EF52E9 ON document (subvention_doc_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76FA9EDA4C');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76B9EF52E9');
        $this->addSql('DROP TABLE subvention');
        $this->addSql('DROP INDEX IDX_D8698A76FA9EDA4C ON document');
        $this->addSql('DROP INDEX IDX_D8698A76B9EF52E9 ON document');
        $this->addSql('ALTER TABLE document DROP subvention_id, DROP subvention_doc_id');
    }
}
