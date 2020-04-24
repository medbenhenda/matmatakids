<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422184808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76886E6264');
        $this->addSql('DROP INDEX IDX_D8698A76886E6264 ON document');
        $this->addSql('ALTER TABLE document ADD doc_file_name VARCHAR(255) DEFAULT NULL, ADD doc_file_original_name VARCHAR(255) DEFAULT NULL, ADD doc_file_mime_type VARCHAR(255) DEFAULT NULL, ADD doc_file_size INT DEFAULT NULL, ADD doc_file_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', DROP name, DROP type, CHANGE creaed_by_id created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76B03A8386 ON document (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76B03A8386');
        $this->addSql('DROP INDEX IDX_D8698A76B03A8386 ON document');
        $this->addSql('ALTER TABLE document ADD creaed_by_id INT DEFAULT NULL, ADD name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD type VARCHAR(16) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP created_by_id, DROP doc_file_name, DROP doc_file_original_name, DROP doc_file_mime_type, DROP doc_file_size, DROP doc_file_dimensions');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76886E6264 FOREIGN KEY (creaed_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76886E6264 ON document (creaed_by_id)');
    }
}
