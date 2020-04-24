<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422155734 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donor DROP owner_id');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A767E3C61F9');
        $this->addSql('DROP INDEX IDX_D8698A767E3C61F9 ON document');
        $this->addSql('ALTER TABLE document ADD creaed_by_id INT DEFAULT NULL, DROP owner_id');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76886E6264 FOREIGN KEY (creaed_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8698A76886E6264 ON document (creaed_by_id)');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CD7E3C61F9');
        $this->addSql('DROP INDEX IDX_ECA209CD7E3C61F9 ON folder');
        $this->addSql('ALTER TABLE folder DROP owner_id');
        $this->addSql('ALTER TABLE project ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEB03A8386 ON project (created_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76886E6264');
        $this->addSql('DROP INDEX IDX_D8698A76886E6264 ON document');
        $this->addSql('ALTER TABLE document ADD owner_id INT NOT NULL, DROP creaed_by_id');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A767E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D8698A767E3C61F9 ON document (owner_id)');
        $this->addSql('ALTER TABLE donor ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder ADD owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_ECA209CD7E3C61F9 ON folder (owner_id)');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB03A8386');
        $this->addSql('DROP INDEX IDX_2FB3D0EEB03A8386 ON project');
        $this->addSql('ALTER TABLE project DROP created_by_id');
    }
}
