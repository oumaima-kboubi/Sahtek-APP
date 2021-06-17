<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613151451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF8A94ABE2');
        $this->addSql('DROP INDEX IDX_D202D7CF8A94ABE2 ON care_taker_order');
        $this->addSql('ALTER TABLE care_taker_order DROP pharmacy_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order ADD pharmacy_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D202D7CF8A94ABE2 ON care_taker_order (pharmacy_id)');
    }
}
