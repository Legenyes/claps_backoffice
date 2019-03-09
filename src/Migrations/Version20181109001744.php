<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109001744 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_B8EE3872742C3FD4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club AS SELECT id, head_office_address_id, name, vat_number FROM club');
        $this->addSql('DROP TABLE club');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, head_office_address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, vat_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_B8EE3872742C3FD4 FOREIGN KEY (head_office_address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO club (id, head_office_address_id, name, vat_number) SELECT id, head_office_address_id, name, vat_number FROM __temp__club');
        $this->addSql('DROP TABLE __temp__club');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872742C3FD4 ON club (head_office_address_id)');
        $this->addSql('DROP INDEX IDX_DF4AB9D761190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club_year AS SELECT id, club_id, date_start, date_stop FROM club_year');
        $this->addSql('DROP TABLE club_year');
        $this->addSql('CREATE TABLE club_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, date_start DATE NOT NULL, date_stop DATE NOT NULL, CONSTRAINT FK_DF4AB9D761190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO club_year (id, club_id, date_start, date_stop) SELECT id, club_id, date_start, date_stop FROM __temp__club_year');
        $this->addSql('DROP TABLE __temp__club_year');
        $this->addSql('CREATE INDEX IDX_DF4AB9D761190A32 ON club_year (club_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_B8EE3872742C3FD4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club AS SELECT id, head_office_address_id, name, vat_number FROM club');
        $this->addSql('DROP TABLE club');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, vat_number VARCHAR(255) DEFAULT NULL, head_office_address_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO club (id, head_office_address_id, name, vat_number) SELECT id, head_office_address_id, name, vat_number FROM __temp__club');
        $this->addSql('DROP TABLE __temp__club');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872742C3FD4 ON club (head_office_address_id)');
        $this->addSql('DROP INDEX IDX_DF4AB9D761190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club_year AS SELECT id, club_id, date_start, date_stop FROM club_year');
        $this->addSql('DROP TABLE club_year');
        $this->addSql('CREATE TABLE club_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, date_start DATE NOT NULL, date_stop DATE NOT NULL)');
        $this->addSql('INSERT INTO club_year (id, club_id, date_start, date_stop) SELECT id, club_id, date_start, date_stop FROM __temp__club_year');
        $this->addSql('DROP TABLE __temp__club_year');
        $this->addSql('CREATE INDEX IDX_DF4AB9D761190A32 ON club_year (club_id)');
    }
}
