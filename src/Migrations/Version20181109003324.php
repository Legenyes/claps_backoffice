<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181109003324 extends AbstractMigration
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL COLLATE BINARY, lastname VARCHAR(255) DEFAULT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, mobile_phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, birthdate DATE DEFAULT NULL, sex VARCHAR(5) DEFAULT NULL COLLATE BINARY, niss VARCHAR(255) DEFAULT NULL COLLATE BINARY, insurer VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_70E4FA78F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member (id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer) SELECT id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78F5B7AF75 ON member (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX UNIQ_B8EE3872742C3FD4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club AS SELECT id, head_office_address_id, name, vat_number FROM club');
        $this->addSql('DROP TABLE club');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, head_office_address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, vat_number VARCHAR(255) DEFAULT NULL)');
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
        $this->addSql('DROP INDEX UNIQ_70E4FA78F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, sex VARCHAR(5) DEFAULT NULL, niss VARCHAR(255) DEFAULT NULL, insurer VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO member (id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer) SELECT id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
    }
}
