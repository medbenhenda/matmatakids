<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506211716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, folder_id INT DEFAULT NULL, folder_item_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, section VARCHAR(128) DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, doc_file_name VARCHAR(255) DEFAULT NULL, doc_file_original_name VARCHAR(255) DEFAULT NULL, doc_file_mime_type VARCHAR(255) DEFAULT NULL, doc_file_size INT DEFAULT NULL, doc_file_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_D8698A76B03A8386 (created_by_id), INDEX IDX_D8698A76162CB942 (folder_id), INDEX IDX_D8698A76ABEC3E2D (folder_item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(16) NOT NULL, city VARCHAR(128) NOT NULL, country VARCHAR(128) NOT NULL, mobile VARCHAR(32) NOT NULL, email VARCHAR(128) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_818CC9D4B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2FB3D0EEB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE don (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, donor_id INT DEFAULT NULL, type_id INT DEFAULT NULL, creaed_by_id INT DEFAULT NULL, amount NUMERIC(7, 2) NOT NULL, date DATETIME NOT NULL, reciepe TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F8F081D9166D1F9C (project_id), INDEX IDX_F8F081D93DD7B7A7 (donor_id), INDEX IDX_F8F081D9C54C8C93 (type_id), INDEX IDX_F8F081D9886E6264 (creaed_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposing_transaction (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, responsible_id INT DEFAULT NULL, affectation_id INT NOT NULL, transaction_date DATETIME DEFAULT NULL, amount NUMERIC(7, 0) NOT NULL, month INT NOT NULL, year INT NOT NULL, recieved TINYINT(1) DEFAULT NULL, recieved_date DATETIME DEFAULT NULL, INDEX IDX_99A24C13B03A8386 (created_by_id), INDEX IDX_99A24C13602AD315 (responsible_id), INDEX IDX_99A24C136D0ABA22 (affectation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donor (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, mobile VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(20) NOT NULL, city VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D7F24097B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affectation (id INT AUTO_INCREMENT NOT NULL, affected_by_id INT DEFAULT NULL, folder_id INT NOT NULL, sponsor_id INT NOT NULL, created_by_id INT DEFAULT NULL, amount NUMERIC(7, 2) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status TINYINT(1) DEFAULT \'1\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F4DD61D369E36731 (affected_by_id), INDEX IDX_F4DD61D3162CB942 (folder_id), INDEX IDX_F4DD61D312F7FB51 (sponsor_id), INDEX IDX_F4DD61D3B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expenses (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, date DATE NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, client_name VARCHAR(255) DEFAULT NULL, category VARCHAR(64) DEFAULT NULL, type VARCHAR(64) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_2496F35BB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(100) DEFAULT NULL, mobile VARCHAR(32) NOT NULL, address VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL, affected TINYINT(1) DEFAULT \'0\', status TINYINT(1) DEFAULT \'0\', created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_ECA209CDB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, mobile VARCHAR(20) NOT NULL, address VARCHAR(255) NOT NULL, zip_code VARCHAR(20) NOT NULL, city VARCHAR(100) NOT NULL, country VARCHAR(100) NOT NULL, position VARCHAR(100) NOT NULL, enter_date DATETIME DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE folder_item (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, first_name VARCHAR(128) NOT NULL, last_name VARCHAR(128) NOT NULL, birthdate DATE DEFAULT NULL, handicapped TINYINT(1) DEFAULT NULL, unhealthy TINYINT(1) DEFAULT NULL, orphan TINYINT(1) DEFAULT NULL, schoolboy TINYINT(1) DEFAULT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_684030B162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_don (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76ABEC3E2D FOREIGN KEY (folder_item_id) REFERENCES folder_item (id)');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D93DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9C54C8C93 FOREIGN KEY (type_id) REFERENCES type_don (id)');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9886E6264 FOREIGN KEY (creaed_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C13602AD315 FOREIGN KEY (responsible_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE proposing_transaction ADD CONSTRAINT FK_99A24C136D0ABA22 FOREIGN KEY (affectation_id) REFERENCES affectation (id)');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F24097B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D369E36731 FOREIGN KEY (affected_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D312F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('ALTER TABLE affectation ADD CONSTRAINT FK_F4DD61D3B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE expenses ADD CONSTRAINT FK_2496F35BB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CDB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE folder_item ADD CONSTRAINT FK_684030B162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D312F7FB51');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9166D1F9C');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D93DD7B7A7');
        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C136D0ABA22');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76162CB942');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3162CB942');
        $this->addSql('ALTER TABLE folder_item DROP FOREIGN KEY FK_684030B162CB942');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76B03A8386');
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D4B03A8386');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB03A8386');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9886E6264');
        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C13B03A8386');
        $this->addSql('ALTER TABLE proposing_transaction DROP FOREIGN KEY FK_99A24C13602AD315');
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F24097B03A8386');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D369E36731');
        $this->addSql('ALTER TABLE affectation DROP FOREIGN KEY FK_F4DD61D3B03A8386');
        $this->addSql('ALTER TABLE expenses DROP FOREIGN KEY FK_2496F35BB03A8386');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CDB03A8386');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76ABEC3E2D');
        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9C54C8C93');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE don');
        $this->addSql('DROP TABLE proposing_transaction');
        $this->addSql('DROP TABLE donor');
        $this->addSql('DROP TABLE affectation');
        $this->addSql('DROP TABLE expenses');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE folder_item');
        $this->addSql('DROP TABLE type_don');
    }
}
