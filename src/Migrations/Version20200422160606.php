<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422160606 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donor ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F24097B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D7F24097B03A8386 ON donor (created_by_id)');
        $this->addSql('ALTER TABLE folder ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE folder ADD CONSTRAINT FK_ECA209CDB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_ECA209CDB03A8386 ON folder (created_by_id)');
        $this->addSql('ALTER TABLE don ADD creaed_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE don ADD CONSTRAINT FK_F8F081D9886E6264 FOREIGN KEY (creaed_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F8F081D9886E6264 ON don (creaed_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE don DROP FOREIGN KEY FK_F8F081D9886E6264');
        $this->addSql('DROP INDEX IDX_F8F081D9886E6264 ON don');
        $this->addSql('ALTER TABLE don DROP creaed_by_id');
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F24097B03A8386');
        $this->addSql('DROP INDEX IDX_D7F24097B03A8386 ON donor');
        $this->addSql('ALTER TABLE donor DROP created_by_id');
        $this->addSql('ALTER TABLE folder DROP FOREIGN KEY FK_ECA209CDB03A8386');
        $this->addSql('DROP INDEX IDX_ECA209CDB03A8386 ON folder');
        $this->addSql('ALTER TABLE folder DROP created_by_id');
    }
}
