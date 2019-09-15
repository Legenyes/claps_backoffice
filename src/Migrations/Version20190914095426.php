<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190914095426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_709B974E4EC001D1');
        $this->addSql('DROP INDEX IDX_709B974EA1915070');
        $this->addSql('DROP INDEX IDX_709B974E5E00894B');
        $this->addSql('DROP INDEX IDX_709B974E8A1E26D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece AS SELECT id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at FROM clothes_piece');
        $this->addSql('DROP TABLE clothes_piece');
        $this->addSql('CREATE TABLE clothes_piece (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, season_id INTEGER DEFAULT NULL, clothe_type_id INTEGER DEFAULT NULL, clothe_texture_id INTEGER DEFAULT NULL, clothe_opportunity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, code VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, country VARCHAR(255) DEFAULT NULL COLLATE BINARY, area VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, personal BOOLEAN DEFAULT NULL, gender CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:array)
        , image VARCHAR(255) DEFAULT NULL COLLATE BINARY, updated_at DATETIME DEFAULT NULL, CONSTRAINT FK_709B974E4EC001D1 FOREIGN KEY (season_id) REFERENCES clothes_season (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_709B974EA1915070 FOREIGN KEY (clothe_type_id) REFERENCES clothes_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_709B974E5E00894B FOREIGN KEY (clothe_texture_id) REFERENCES clothes_texture (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_709B974E8A1E26D FOREIGN KEY (clothe_opportunity_id) REFERENCES clothes_opportunity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_piece (id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at) SELECT id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at FROM __temp__clothes_piece');
        $this->addSql('DROP TABLE __temp__clothes_piece');
        $this->addSql('CREATE INDEX IDX_709B974E4EC001D1 ON clothes_piece (season_id)');
        $this->addSql('CREATE INDEX IDX_709B974EA1915070 ON clothes_piece (clothe_type_id)');
        $this->addSql('CREATE INDEX IDX_709B974E5E00894B ON clothes_piece (clothe_texture_id)');
        $this->addSql('CREATE INDEX IDX_709B974E8A1E26D ON clothes_piece (clothe_opportunity_id)');
        $this->addSql('DROP INDEX IDX_C13005B0D823E37A');
        $this->addSql('DROP INDEX IDX_C13005B04598339B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_section AS SELECT clothes_piece_id, section_id FROM clothes_piece_section');
        $this->addSql('DROP TABLE clothes_piece_section');
        $this->addSql('CREATE TABLE clothes_piece_section (clothes_piece_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(clothes_piece_id, section_id), CONSTRAINT FK_C13005B04598339B FOREIGN KEY (clothes_piece_id) REFERENCES clothes_piece (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C13005B0D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_piece_section (clothes_piece_id, section_id) SELECT clothes_piece_id, section_id FROM __temp__clothes_piece_section');
        $this->addSql('DROP TABLE __temp__clothes_piece_section');
        $this->addSql('CREATE INDEX IDX_C13005B0D823E37A ON clothes_piece_section (section_id)');
        $this->addSql('CREATE INDEX IDX_C13005B04598339B ON clothes_piece_section (clothes_piece_id)');
        $this->addSql('DROP INDEX UNIQ_B8EE3872742C3FD4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club AS SELECT id, head_office_address_id, name, vat_number FROM club');
        $this->addSql('DROP TABLE club');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, head_office_address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, vat_number VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_B8EE3872742C3FD4 FOREIGN KEY (head_office_address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO club (id, head_office_address_id, name, vat_number) SELECT id, head_office_address_id, name, vat_number FROM __temp__club');
        $this->addSql('DROP TABLE __temp__club');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872742C3FD4 ON club (head_office_address_id)');
        $this->addSql('DROP INDEX IDX_6B8C7784D895B25');
        $this->addSql('DROP INDEX IDX_6B8C7787597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ship AS SELECT id, member_id, club_year_id, start_date, end_date, subscription_amount, subscription_paid_at FROM member_ship');
        $this->addSql('DROP TABLE member_ship');
        $this->addSql('CREATE TABLE member_ship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, member_id INTEGER NOT NULL, club_year_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, subscription_amount NUMERIC(10, 2) DEFAULT NULL, subscription_paid_at DATE DEFAULT NULL, CONSTRAINT FK_6B8C7784D895B25 FOREIGN KEY (club_year_id) REFERENCES club_year (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6B8C7787597D3FE FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member_ship (id, member_id, club_year_id, start_date, end_date, subscription_amount, subscription_paid_at) SELECT id, member_id, club_year_id, start_date, end_date, subscription_amount, subscription_paid_at FROM __temp__member_ship');
        $this->addSql('DROP TABLE __temp__member_ship');
        $this->addSql('CREATE INDEX IDX_6B8C7784D895B25 ON member_ship (club_year_id)');
        $this->addSql('CREATE INDEX IDX_6B8C7787597D3FE ON member_ship (member_id)');
        $this->addSql('DROP INDEX IDX_56EDD40AD823E37A');
        $this->addSql('DROP INDEX IDX_56EDD40A7DA286E9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ship_section AS SELECT member_ship_id, section_id FROM member_ship_section');
        $this->addSql('DROP TABLE member_ship_section');
        $this->addSql('CREATE TABLE member_ship_section (member_ship_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(member_ship_id, section_id), CONSTRAINT FK_56EDD40A7DA286E9 FOREIGN KEY (member_ship_id) REFERENCES member_ship (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_56EDD40AD823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member_ship_section (member_ship_id, section_id) SELECT member_ship_id, section_id FROM __temp__member_ship_section');
        $this->addSql('DROP TABLE __temp__member_ship_section');
        $this->addSql('CREATE INDEX IDX_56EDD40AD823E37A ON member_ship_section (section_id)');
        $this->addSql('CREATE INDEX IDX_56EDD40A7DA286E9 ON member_ship_section (member_ship_id)');
        $this->addSql('DROP INDEX IDX_D97868E3CFCDCFA6');
        $this->addSql('DROP INDEX IDX_D97868E3C40FCFA8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume_piece AS SELECT id, costume_id, piece_id, is_default FROM clothes_costume_piece');
        $this->addSql('DROP TABLE clothes_costume_piece');
        $this->addSql('CREATE TABLE clothes_costume_piece (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, costume_id INTEGER NOT NULL, piece_id INTEGER NOT NULL, is_default BOOLEAN NOT NULL, CONSTRAINT FK_D97868E3CFCDCFA6 FOREIGN KEY (costume_id) REFERENCES clothes_costume (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D97868E3C40FCFA8 FOREIGN KEY (piece_id) REFERENCES clothes_piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_costume_piece (id, costume_id, piece_id, is_default) SELECT id, costume_id, piece_id, is_default FROM __temp__clothes_costume_piece');
        $this->addSql('DROP TABLE __temp__clothes_costume_piece');
        $this->addSql('CREATE INDEX IDX_D97868E3CFCDCFA6 ON clothes_costume_piece (costume_id)');
        $this->addSql('CREATE INDEX IDX_D97868E3C40FCFA8 ON clothes_costume_piece (piece_id)');
        $this->addSql('DROP INDEX IDX_A9CA24154598339B');
        $this->addSql('DROP INDEX IDX_A9CA2415F43EAE46');
        $this->addSql('DROP INDEX IDX_A9CA2415E632D4DC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_stock AS SELECT id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status FROM clothes_piece_stock');
        $this->addSql('DROP TABLE clothes_piece_stock');
        $this->addSql('CREATE TABLE clothes_piece_stock (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, clothes_piece_id INTEGER NOT NULL, dress_maker_id INTEGER DEFAULT NULL, dress_keeper_id INTEGER DEFAULT NULL, personal BOOLEAN NOT NULL, status VARCHAR(32) NOT NULL COLLATE BINARY, CONSTRAINT FK_A9CA24154598339B FOREIGN KEY (clothes_piece_id) REFERENCES clothes_piece (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A9CA2415F43EAE46 FOREIGN KEY (dress_maker_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A9CA2415E632D4DC FOREIGN KEY (dress_keeper_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_piece_stock (id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status) SELECT id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status FROM __temp__clothes_piece_stock');
        $this->addSql('DROP TABLE __temp__clothes_piece_stock');
        $this->addSql('CREATE INDEX IDX_A9CA24154598339B ON clothes_piece_stock (clothes_piece_id)');
        $this->addSql('CREATE INDEX IDX_A9CA2415F43EAE46 ON clothes_piece_stock (dress_maker_id)');
        $this->addSql('CREATE INDEX IDX_A9CA2415E632D4DC ON clothes_piece_stock (dress_keeper_id)');
        $this->addSql('DROP INDEX IDX_5C225374F6F56E0A');
        $this->addSql('DROP INDEX IDX_5C225374FB4DE386');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_stock_clothes_color AS SELECT clothes_piece_stock_id, clothes_color_id FROM clothes_piece_stock_clothes_color');
        $this->addSql('DROP TABLE clothes_piece_stock_clothes_color');
        $this->addSql('CREATE TABLE clothes_piece_stock_clothes_color (clothes_piece_stock_id INTEGER NOT NULL, clothes_color_id INTEGER NOT NULL, PRIMARY KEY(clothes_piece_stock_id, clothes_color_id), CONSTRAINT FK_5C225374F6F56E0A FOREIGN KEY (clothes_piece_stock_id) REFERENCES clothes_piece_stock (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5C225374FB4DE386 FOREIGN KEY (clothes_color_id) REFERENCES clothes_color (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_piece_stock_clothes_color (clothes_piece_stock_id, clothes_color_id) SELECT clothes_piece_stock_id, clothes_color_id FROM __temp__clothes_piece_stock_clothes_color');
        $this->addSql('DROP TABLE __temp__clothes_piece_stock_clothes_color');
        $this->addSql('CREATE INDEX IDX_5C225374F6F56E0A ON clothes_piece_stock_clothes_color (clothes_piece_stock_id)');
        $this->addSql('CREATE INDEX IDX_5C225374FB4DE386 ON clothes_piece_stock_clothes_color (clothes_color_id)');
        $this->addSql('DROP INDEX IDX_12E44D0F4EC001D1');
        $this->addSql('DROP INDEX IDX_12E44D0F8A1E26D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume AS SELECT id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender FROM clothes_costume');
        $this->addSql('DROP TABLE clothes_costume');
        $this->addSql('CREATE TABLE clothes_costume (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, season_id INTEGER DEFAULT NULL, clothe_opportunity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, code VARCHAR(255) NOT NULL COLLATE BINARY, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, country VARCHAR(255) DEFAULT NULL COLLATE BINARY, area VARCHAR(255) DEFAULT NULL COLLATE BINARY, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, gender CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:array)
        , CONSTRAINT FK_12E44D0F4EC001D1 FOREIGN KEY (season_id) REFERENCES clothes_season (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_12E44D0F8A1E26D FOREIGN KEY (clothe_opportunity_id) REFERENCES clothes_opportunity (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_costume (id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender) SELECT id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender FROM __temp__clothes_costume');
        $this->addSql('DROP TABLE __temp__clothes_costume');
        $this->addSql('CREATE INDEX IDX_12E44D0F4EC001D1 ON clothes_costume (season_id)');
        $this->addSql('CREATE INDEX IDX_12E44D0F8A1E26D ON clothes_costume (clothe_opportunity_id)');
        $this->addSql('DROP INDEX IDX_323200F18FAD9536');
        $this->addSql('DROP INDEX IDX_323200F1D823E37A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume_section AS SELECT clothes_costume_id, section_id FROM clothes_costume_section');
        $this->addSql('DROP TABLE clothes_costume_section');
        $this->addSql('CREATE TABLE clothes_costume_section (clothes_costume_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(clothes_costume_id, section_id), CONSTRAINT FK_323200F18FAD9536 FOREIGN KEY (clothes_costume_id) REFERENCES clothes_costume (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_323200F1D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_costume_section (clothes_costume_id, section_id) SELECT clothes_costume_id, section_id FROM __temp__clothes_costume_section');
        $this->addSql('DROP TABLE __temp__clothes_costume_section');
        $this->addSql('CREATE INDEX IDX_323200F18FAD9536 ON clothes_costume_section (clothes_costume_id)');
        $this->addSql('CREATE INDEX IDX_323200F1D823E37A ON clothes_costume_section (section_id)');
        $this->addSql('DROP INDEX IDX_DF4AB9D761190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club_year AS SELECT id, club_id, date_start, date_stop, is_active FROM club_year');
        $this->addSql('DROP TABLE club_year');
        $this->addSql('CREATE TABLE club_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, date_start DATE NOT NULL, date_stop DATE NOT NULL, is_active BOOLEAN DEFAULT NULL, CONSTRAINT FK_DF4AB9D761190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO club_year (id, club_id, date_start, date_stop, is_active) SELECT id, club_id, date_start, date_stop, is_active FROM __temp__club_year');
        $this->addSql('DROP TABLE __temp__club_year');
        $this->addSql('CREATE INDEX IDX_DF4AB9D761190A32 ON club_year (club_id)');
        $this->addSql('DROP INDEX IDX_B39BC640C54C8C93');
        $this->addSql('DROP INDEX IDX_B39BC6409F2C3FAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_type AS SELECT id, type_id, zone_id, name FROM clothes_type');
        $this->addSql('DROP TABLE clothes_type');
        $this->addSql('CREATE TABLE clothes_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, zone_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_B39BC640C54C8C93 FOREIGN KEY (type_id) REFERENCES clothes_type_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B39BC6409F2C3FAB FOREIGN KEY (zone_id) REFERENCES clothes_type_zone (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO clothes_type (id, type_id, zone_id, name) SELECT id, type_id, zone_id, name FROM __temp__clothes_type');
        $this->addSql('DROP TABLE __temp__clothes_type');
        $this->addSql('CREATE INDEX IDX_B39BC640C54C8C93 ON clothes_type (type_id)');
        $this->addSql('CREATE INDEX IDX_B39BC6409F2C3FAB ON clothes_type (zone_id)');
        $this->addSql('DROP INDEX UNIQ_70E4FA78F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL COLLATE BINARY, lastname VARCHAR(255) DEFAULT NULL COLLATE BINARY, email VARCHAR(255) DEFAULT NULL COLLATE BINARY, phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, mobile_phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, birthdate DATE DEFAULT NULL, sex VARCHAR(5) DEFAULT NULL COLLATE BINARY, niss VARCHAR(255) DEFAULT NULL COLLATE BINARY, insurer VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_70E4FA78F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO member (id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer) SELECT id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78F5B7AF75 ON member (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_12E44D0F4EC001D1');
        $this->addSql('DROP INDEX IDX_12E44D0F8A1E26D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume AS SELECT id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender FROM clothes_costume');
        $this->addSql('DROP TABLE clothes_costume');
        $this->addSql('CREATE TABLE clothes_costume (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, season_id INTEGER DEFAULT NULL, clothe_opportunity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, area VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, gender CLOB DEFAULT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO clothes_costume (id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender) SELECT id, season_id, clothe_opportunity_id, name, code, description, country, area, city, gender FROM __temp__clothes_costume');
        $this->addSql('DROP TABLE __temp__clothes_costume');
        $this->addSql('CREATE INDEX IDX_12E44D0F4EC001D1 ON clothes_costume (season_id)');
        $this->addSql('CREATE INDEX IDX_12E44D0F8A1E26D ON clothes_costume (clothe_opportunity_id)');
        $this->addSql('DROP INDEX IDX_D97868E3CFCDCFA6');
        $this->addSql('DROP INDEX IDX_D97868E3C40FCFA8');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume_piece AS SELECT id, costume_id, piece_id, is_default FROM clothes_costume_piece');
        $this->addSql('DROP TABLE clothes_costume_piece');
        $this->addSql('CREATE TABLE clothes_costume_piece (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, costume_id INTEGER NOT NULL, piece_id INTEGER NOT NULL, is_default BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO clothes_costume_piece (id, costume_id, piece_id, is_default) SELECT id, costume_id, piece_id, is_default FROM __temp__clothes_costume_piece');
        $this->addSql('DROP TABLE __temp__clothes_costume_piece');
        $this->addSql('CREATE INDEX IDX_D97868E3CFCDCFA6 ON clothes_costume_piece (costume_id)');
        $this->addSql('CREATE INDEX IDX_D97868E3C40FCFA8 ON clothes_costume_piece (piece_id)');
        $this->addSql('DROP INDEX IDX_323200F18FAD9536');
        $this->addSql('DROP INDEX IDX_323200F1D823E37A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_costume_section AS SELECT clothes_costume_id, section_id FROM clothes_costume_section');
        $this->addSql('DROP TABLE clothes_costume_section');
        $this->addSql('CREATE TABLE clothes_costume_section (clothes_costume_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(clothes_costume_id, section_id))');
        $this->addSql('INSERT INTO clothes_costume_section (clothes_costume_id, section_id) SELECT clothes_costume_id, section_id FROM __temp__clothes_costume_section');
        $this->addSql('DROP TABLE __temp__clothes_costume_section');
        $this->addSql('CREATE INDEX IDX_323200F18FAD9536 ON clothes_costume_section (clothes_costume_id)');
        $this->addSql('CREATE INDEX IDX_323200F1D823E37A ON clothes_costume_section (section_id)');
        $this->addSql('DROP INDEX IDX_709B974E4EC001D1');
        $this->addSql('DROP INDEX IDX_709B974EA1915070');
        $this->addSql('DROP INDEX IDX_709B974E5E00894B');
        $this->addSql('DROP INDEX IDX_709B974E8A1E26D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece AS SELECT id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at FROM clothes_piece');
        $this->addSql('DROP TABLE clothes_piece');
        $this->addSql('CREATE TABLE clothes_piece (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, season_id INTEGER DEFAULT NULL, clothe_type_id INTEGER DEFAULT NULL, clothe_texture_id INTEGER DEFAULT NULL, clothe_opportunity_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, area VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, personal BOOLEAN DEFAULT NULL, gender CLOB DEFAULT NULL --(DC2Type:array)
        , image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO clothes_piece (id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at) SELECT id, season_id, clothe_type_id, clothe_texture_id, clothe_opportunity_id, name, code, description, country, area, city, personal, gender, image, updated_at FROM __temp__clothes_piece');
        $this->addSql('DROP TABLE __temp__clothes_piece');
        $this->addSql('CREATE INDEX IDX_709B974E4EC001D1 ON clothes_piece (season_id)');
        $this->addSql('CREATE INDEX IDX_709B974EA1915070 ON clothes_piece (clothe_type_id)');
        $this->addSql('CREATE INDEX IDX_709B974E5E00894B ON clothes_piece (clothe_texture_id)');
        $this->addSql('CREATE INDEX IDX_709B974E8A1E26D ON clothes_piece (clothe_opportunity_id)');
        $this->addSql('DROP INDEX IDX_C13005B04598339B');
        $this->addSql('DROP INDEX IDX_C13005B0D823E37A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_section AS SELECT clothes_piece_id, section_id FROM clothes_piece_section');
        $this->addSql('DROP TABLE clothes_piece_section');
        $this->addSql('CREATE TABLE clothes_piece_section (clothes_piece_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(clothes_piece_id, section_id))');
        $this->addSql('INSERT INTO clothes_piece_section (clothes_piece_id, section_id) SELECT clothes_piece_id, section_id FROM __temp__clothes_piece_section');
        $this->addSql('DROP TABLE __temp__clothes_piece_section');
        $this->addSql('CREATE INDEX IDX_C13005B04598339B ON clothes_piece_section (clothes_piece_id)');
        $this->addSql('CREATE INDEX IDX_C13005B0D823E37A ON clothes_piece_section (section_id)');
        $this->addSql('DROP INDEX IDX_A9CA24154598339B');
        $this->addSql('DROP INDEX IDX_A9CA2415F43EAE46');
        $this->addSql('DROP INDEX IDX_A9CA2415E632D4DC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_stock AS SELECT id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status FROM clothes_piece_stock');
        $this->addSql('DROP TABLE clothes_piece_stock');
        $this->addSql('CREATE TABLE clothes_piece_stock (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, clothes_piece_id INTEGER NOT NULL, dress_maker_id INTEGER DEFAULT NULL, dress_keeper_id INTEGER DEFAULT NULL, personal BOOLEAN NOT NULL, status VARCHAR(32) NOT NULL)');
        $this->addSql('INSERT INTO clothes_piece_stock (id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status) SELECT id, clothes_piece_id, dress_maker_id, dress_keeper_id, personal, status FROM __temp__clothes_piece_stock');
        $this->addSql('DROP TABLE __temp__clothes_piece_stock');
        $this->addSql('CREATE INDEX IDX_A9CA24154598339B ON clothes_piece_stock (clothes_piece_id)');
        $this->addSql('CREATE INDEX IDX_A9CA2415F43EAE46 ON clothes_piece_stock (dress_maker_id)');
        $this->addSql('CREATE INDEX IDX_A9CA2415E632D4DC ON clothes_piece_stock (dress_keeper_id)');
        $this->addSql('DROP INDEX IDX_5C225374F6F56E0A');
        $this->addSql('DROP INDEX IDX_5C225374FB4DE386');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_piece_stock_clothes_color AS SELECT clothes_piece_stock_id, clothes_color_id FROM clothes_piece_stock_clothes_color');
        $this->addSql('DROP TABLE clothes_piece_stock_clothes_color');
        $this->addSql('CREATE TABLE clothes_piece_stock_clothes_color (clothes_piece_stock_id INTEGER NOT NULL, clothes_color_id INTEGER NOT NULL, PRIMARY KEY(clothes_piece_stock_id, clothes_color_id))');
        $this->addSql('INSERT INTO clothes_piece_stock_clothes_color (clothes_piece_stock_id, clothes_color_id) SELECT clothes_piece_stock_id, clothes_color_id FROM __temp__clothes_piece_stock_clothes_color');
        $this->addSql('DROP TABLE __temp__clothes_piece_stock_clothes_color');
        $this->addSql('CREATE INDEX IDX_5C225374F6F56E0A ON clothes_piece_stock_clothes_color (clothes_piece_stock_id)');
        $this->addSql('CREATE INDEX IDX_5C225374FB4DE386 ON clothes_piece_stock_clothes_color (clothes_color_id)');
        $this->addSql('DROP INDEX IDX_B39BC640C54C8C93');
        $this->addSql('DROP INDEX IDX_B39BC6409F2C3FAB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__clothes_type AS SELECT id, type_id, zone_id, name FROM clothes_type');
        $this->addSql('DROP TABLE clothes_type');
        $this->addSql('CREATE TABLE clothes_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, zone_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO clothes_type (id, type_id, zone_id, name) SELECT id, type_id, zone_id, name FROM __temp__clothes_type');
        $this->addSql('DROP TABLE __temp__clothes_type');
        $this->addSql('CREATE INDEX IDX_B39BC640C54C8C93 ON clothes_type (type_id)');
        $this->addSql('CREATE INDEX IDX_B39BC6409F2C3FAB ON clothes_type (zone_id)');
        $this->addSql('DROP INDEX UNIQ_B8EE3872742C3FD4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club AS SELECT id, head_office_address_id, name, vat_number FROM club');
        $this->addSql('DROP TABLE club');
        $this->addSql('CREATE TABLE club (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, head_office_address_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, vat_number VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO club (id, head_office_address_id, name, vat_number) SELECT id, head_office_address_id, name, vat_number FROM __temp__club');
        $this->addSql('DROP TABLE __temp__club');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B8EE3872742C3FD4 ON club (head_office_address_id)');
        $this->addSql('DROP INDEX IDX_DF4AB9D761190A32');
        $this->addSql('CREATE TEMPORARY TABLE __temp__club_year AS SELECT id, club_id, date_start, date_stop, is_active FROM club_year');
        $this->addSql('DROP TABLE club_year');
        $this->addSql('CREATE TABLE club_year (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_id INTEGER DEFAULT NULL, date_start DATE NOT NULL, date_stop DATE NOT NULL, is_active BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO club_year (id, club_id, date_start, date_stop, is_active) SELECT id, club_id, date_start, date_stop, is_active FROM __temp__club_year');
        $this->addSql('DROP TABLE __temp__club_year');
        $this->addSql('CREATE INDEX IDX_DF4AB9D761190A32 ON club_year (club_id)');
        $this->addSql('DROP INDEX UNIQ_70E4FA78F5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, address_id INTEGER DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, sex VARCHAR(5) DEFAULT NULL, niss VARCHAR(255) DEFAULT NULL, insurer VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO member (id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer) SELECT id, address_id, firstname, lastname, email, phone, mobile_phone, birthdate, sex, niss, insurer FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78F5B7AF75 ON member (address_id)');
        $this->addSql('DROP INDEX IDX_6B8C7784D895B25');
        $this->addSql('DROP INDEX IDX_6B8C7787597D3FE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ship AS SELECT id, club_year_id, member_id, start_date, end_date, subscription_amount, subscription_paid_at FROM member_ship');
        $this->addSql('DROP TABLE member_ship');
        $this->addSql('CREATE TABLE member_ship (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, club_year_id INTEGER NOT NULL, member_id INTEGER NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, subscription_amount NUMERIC(10, 2) DEFAULT NULL, subscription_paid_at DATE DEFAULT NULL)');
        $this->addSql('INSERT INTO member_ship (id, club_year_id, member_id, start_date, end_date, subscription_amount, subscription_paid_at) SELECT id, club_year_id, member_id, start_date, end_date, subscription_amount, subscription_paid_at FROM __temp__member_ship');
        $this->addSql('DROP TABLE __temp__member_ship');
        $this->addSql('CREATE INDEX IDX_6B8C7784D895B25 ON member_ship (club_year_id)');
        $this->addSql('CREATE INDEX IDX_6B8C7787597D3FE ON member_ship (member_id)');
        $this->addSql('DROP INDEX IDX_56EDD40A7DA286E9');
        $this->addSql('DROP INDEX IDX_56EDD40AD823E37A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__member_ship_section AS SELECT member_ship_id, section_id FROM member_ship_section');
        $this->addSql('DROP TABLE member_ship_section');
        $this->addSql('CREATE TABLE member_ship_section (member_ship_id INTEGER NOT NULL, section_id INTEGER NOT NULL, PRIMARY KEY(member_ship_id, section_id))');
        $this->addSql('INSERT INTO member_ship_section (member_ship_id, section_id) SELECT member_ship_id, section_id FROM __temp__member_ship_section');
        $this->addSql('DROP TABLE __temp__member_ship_section');
        $this->addSql('CREATE INDEX IDX_56EDD40A7DA286E9 ON member_ship_section (member_ship_id)');
        $this->addSql('CREATE INDEX IDX_56EDD40AD823E37A ON member_ship_section (section_id)');
    }
}
