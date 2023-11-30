<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115221131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (idAvis INT AUTO_INCREMENT NOT NULL, detailAvisService VARCHAR(255) NOT NULL, noteService INT NOT NULL, idArticle INT NOT NULL, idUser INT NOT NULL, PRIMARY KEY(idAvis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (idReclamation INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, screenshot VARCHAR(255) DEFAULT NULL, numero_mobile VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, date_traitement DATE DEFAULT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, nomServcie VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(idReclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE reclamation');
    }
}
