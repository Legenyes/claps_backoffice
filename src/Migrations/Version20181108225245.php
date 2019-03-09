<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181108225245 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, head_office_address_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, vat_number VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872742C3FD4 ON club (head_office_address_id)');
        $this->addSql('CREATE TABLE section (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE club_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, relation_id INTEGER DEFAULT NULL, date_start DATE NOT NULL, date_stop DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_DF4AB9D73256915B ON club_year (relation_id)');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, sex VARCHAR(5) DEFAULT NULL, niss VARCHAR(255) DEFAULT NULL, insurer VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE address (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, street VARCHAR(255) DEFAULT NULL, street_number VARCHAR(20) DEFAULT NULL, street_box VARCHAR(20) DEFAULT NULL, zip_code VARCHAR(20) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(10) DEFAULT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE club_year');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE address');
    }
}
