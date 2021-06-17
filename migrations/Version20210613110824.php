<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613110824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE drug_stock (id INT AUTO_INCREMENT NOT NULL, pharmacy_id INT DEFAULT NULL, drug_stock_pharmacy_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_3FBED1EF8A94ABE2 (pharmacy_id), INDEX IDX_3FBED1EF414E0677 (drug_stock_pharmacy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE drug_stock_pharmacy (id INT AUTO_INCREMENT NOT NULL, quantity NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE drug_stock ADD CONSTRAINT FK_3FBED1EF8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE drug_stock ADD CONSTRAINT FK_3FBED1EF414E0677 FOREIGN KEY (drug_stock_pharmacy_id) REFERENCES drug_stock_pharmacy (id)');
        $this->addSql('ALTER TABLE drug ADD drug_stock_pharmacy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drug ADD CONSTRAINT FK_43EB7A3E414E0677 FOREIGN KEY (drug_stock_pharmacy_id) REFERENCES drug_stock_pharmacy (id)');
        $this->addSql('CREATE INDEX IDX_43EB7A3E414E0677 ON drug (drug_stock_pharmacy_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drug DROP FOREIGN KEY FK_43EB7A3E414E0677');
        $this->addSql('ALTER TABLE drug_stock DROP FOREIGN KEY FK_3FBED1EF414E0677');
        $this->addSql('DROP TABLE drug_stock');
        $this->addSql('DROP TABLE drug_stock_pharmacy');
        $this->addSql('DROP INDEX IDX_43EB7A3E414E0677 ON drug');
        $this->addSql('ALTER TABLE drug DROP drug_stock_pharmacy_id');
    }
}
