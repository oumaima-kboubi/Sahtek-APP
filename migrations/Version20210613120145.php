<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613120145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order ADD pending TINYINT(1) NOT NULL, ADD deleted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE drug_order ADD pending TINYINT(1) NOT NULL, ADD description VARCHAR(255) NOT NULL, ADD deleted TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order DROP pending, DROP deleted');
        $this->addSql('ALTER TABLE drug_order DROP pending, DROP description, DROP deleted');
    }
}
