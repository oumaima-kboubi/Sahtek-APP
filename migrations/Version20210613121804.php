<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613121804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF19EB6921');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF3F070B8B');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF8A94ABE2');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF19EB6921 FOREIGN KEY (client_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF3F070B8B FOREIGN KEY (caretaker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF19EB6921');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF8A94ABE2');
        $this->addSql('ALTER TABLE care_taker_order DROP FOREIGN KEY FK_D202D7CF3F070B8B');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF19EB6921 FOREIGN KEY (client_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF8A94ABE2 FOREIGN KEY (pharmacy_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE care_taker_order ADD CONSTRAINT FK_D202D7CF3F070B8B FOREIGN KEY (caretaker_id) REFERENCES person (id)');
    }
}
