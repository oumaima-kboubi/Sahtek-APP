<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611144328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE belong (id INT AUTO_INCREMENT NOT NULL, drug_id INT DEFAULT NULL, pharmacy_id INT NOT NULL, quantity NUMERIC(10, 0) NOT NULL, promotion TINYINT(1) NOT NULL, initial_price NUMERIC(10, 0) NOT NULL, final_price NUMERIC(10, 0) NOT NULL, pourcentage NUMERIC(10, 0) NOT NULL, INDEX IDX_BFFF81BBAABCA765 (drug_id), INDEX IDX_BFFF81BB8A94ABE2 (pharmacy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE care_taker_order (id INT AUTO_INCREMENT NOT NULL, caretaker_id INT DEFAULT NULL, pharmacy_id INT DEFAULT NULL, client_id INT DEFAULT NULL, day DATE NOT NULL, start_time DATETIME NOT NULL, finish_time DATETIME NOT NULL, price NUMERIC(10, 0) NOT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_D202D7CF3F070B8B (caretaker_id), INDEX IDX_D202D7CF8A94ABE2 (pharmacy_id), INDEX IDX_D202D7CF19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, entreprise_id INT NOT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 0) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_43EB7A3EC54C8C93 (type_id), INDEX IDX_43EB7A3EA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug_order (id INT AUTO_INCREMENT NOT NULL, drug_id INT DEFAULT NULL, client_id INT DEFAULT NULL, pharmacy_id INT DEFAULT NULL, price NUMERIC(10, 0) NOT NULL, quantity NUMERIC(10, 0) NOT NULL, approved TINYINT(1) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_81A11417AABCA765 (drug_id), INDEX IDX_81A1141719EB6921 (client_id), INDEX IDX_81A114178A94ABE2 (pharmacy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE money (id INT AUTO_INCREMENT NOT NULL, solde NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, adress_id INT NOT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(50) NOT NULL, age INT NOT NULL, city VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, solde NUMERIC(10, 0) NOT NULL, cin INT NOT NULL, path VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, INDEX IDX_34DCD1768486F9AC (adress_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BBAABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id)');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BB8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF3F070B8B FOREIGN KEY (caretaker_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF19EB6921 FOREIGN KEY (client_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE drug ADD CONSTRAINT FK_43EB7A3EC54C8C93 FOREIGN KEY (type_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE drug ADD CONSTRAINT FK_43EB7A3EA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A11417AABCA765 FOREIGN KEY (drug_id) REFERENCES drug (id)');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A1141719EB6921 FOREIGN KEY (client_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A114178A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1768486F9AC FOREIGN KEY (adress_id) REFERENCES city (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drug DROP FOREIGN KEY FK_43EB7A3EC54C8C93');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1768486F9AC');
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_BFFF81BBAABCA765');
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A11417AABCA765');
        $this->addSql('ALTER TABLE drug DROP FOREIGN KEY FK_43EB7A3EA4AEAFEA');
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_BFFF81BB8A94ABE2');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF3F070B8B');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF8A94ABE2');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF19EB6921');
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A1141719EB6921');
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A114178A94ABE2');
        $this->addSql('DROP TABLE belong');
        $this->addSql('DROP TABLE care_taker_order');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE drug');
        $this->addSql('DROP TABLE drug_order');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE money');
        $this->addSql('DROP TABLE person');
    }
}
