<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122051755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B26681EA4AEAFEA ON evenement (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EA4AEAFEA');
        $this->addSql('DROP INDEX IDX_B26681EA4AEAFEA ON evenement');
        $this->addSql('ALTER TABLE evenement DROP entreprise_id');
    }
}
