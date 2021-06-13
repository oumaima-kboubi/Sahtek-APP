<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613125348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A1141719EB6921');
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A114178A94ABE2');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A1141719EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A114178A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A1141719EB6921');
        $this->addSql('ALTER TABLE drug_order DROP FOREIGN KEY FK_81A114178A94ABE2');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A1141719EB6921 FOREIGN KEY (client_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE drug_order ADD CONSTRAINT FK_81A114178A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
    }
}
