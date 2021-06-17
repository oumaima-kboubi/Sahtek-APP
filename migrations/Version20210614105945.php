<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614105945 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_BFFF81BB8A94ABE2');
        $this->addSql('ALTER TABLE belong CHANGE pharmacy_id pharmacy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BB8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE belong DROP FOREIGN KEY FK_BFFF81BB8A94ABE2');
        $this->addSql('ALTER TABLE belong CHANGE pharmacy_id pharmacy_id INT NOT NULL');
        $this->addSql('ALTER TABLE belong ADD CONSTRAINT FK_BFFF81BB8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
    }
}
