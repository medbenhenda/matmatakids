<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200523233512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE beneficiary (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, folder_id INT DEFAULT NULL, first_name VARCHAR(128) NOT NULL, last_name VARCHAR(128) NOT NULL, birhdate DATE DEFAULT NULL, phone VARCHAR(16) DEFAULT NULL, email VARCHAR(128) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(8) DEFAULT NULL, city VARCHAR(128) NOT NULL, country VARCHAR(64) DEFAULT NULL, school_level VARCHAR(255) DEFAULT NULL, is_orphan TINYINT(1) DEFAULT NULL, is_handicapped TINYINT(1) DEFAULT NULL, is_unhealty TINYINT(1) DEFAULT NULL, is_school_boy TINYINT(1) DEFAULT NULL, particular_case LONGTEXT DEFAULT NULL, favorite_activity LONGTEXT DEFAULT NULL, have_afolder TINYINT(1) DEFAULT NULL, INDEX IDX_7ABF446AB03A8386 (created_by_id), UNIQUE INDEX UNIQ_7ABF446A162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary_project (beneficiary_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_F26A8544ECCAAFA0 (beneficiary_id), INDEX IDX_F26A8544166D1F9C (project_id), PRIMARY KEY(beneficiary_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446A162CB942 FOREIGN KEY (folder_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE beneficiary_project ADD CONSTRAINT FK_F26A8544ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE beneficiary_project ADD CONSTRAINT FK_F26A8544166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beneficiary_project DROP FOREIGN KEY FK_F26A8544ECCAAFA0');
        $this->addSql('DROP TABLE beneficiary');
        $this->addSql('DROP TABLE beneficiary_project');
    }
}
