<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116093858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libellet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energie (id INT AUTO_INCREMENT NOT NULL, libellet_energie VARCHAR(255) DEFAULT NULL, pollution_par_kw DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, libellet_produit VARCHAR(255) DEFAULT NULL, prix INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, production_mentuelle INT DEFAULT NULL, stock_actuelle INT DEFAULT NULL, pollution_par_piece DOUBLE PRECISION DEFAULT NULL, consommation_energie LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', distance_vehicule LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_29A5EC27BCF5E72D (categorie_id), INDEX IDX_29A5EC27A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_vehicule (produit_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_30CD0EF347EFB (produit_id), INDEX IDX_30CD0E4A4A3511 (vehicule_id), PRIMARY KEY(produit_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_energie (produit_id INT NOT NULL, energie_id INT NOT NULL, INDEX IDX_E47C51D9F347EFB (produit_id), INDEX IDX_E47C51D9B732A364 (energie_id), PRIMARY KEY(produit_id, energie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, libellet_vehicule VARCHAR(255) DEFAULT NULL, marque_vehicule VARCHAR(255) DEFAULT NULL, pollutio_par_km DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE produit_vehicule ADD CONSTRAINT FK_30CD0EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_vehicule ADD CONSTRAINT FK_30CD0E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_energie ADD CONSTRAINT FK_E47C51D9F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_energie ADD CONSTRAINT FK_E47C51D9B732A364 FOREIGN KEY (energie_id) REFERENCES energie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_Commande_Panier');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A4AEAFEA');
        $this->addSql('ALTER TABLE produit_vehicule DROP FOREIGN KEY FK_30CD0EF347EFB');
        $this->addSql('ALTER TABLE produit_vehicule DROP FOREIGN KEY FK_30CD0E4A4A3511');
        $this->addSql('ALTER TABLE produit_energie DROP FOREIGN KEY FK_E47C51D9F347EFB');
        $this->addSql('ALTER TABLE produit_energie DROP FOREIGN KEY FK_E47C51D9B732A364');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE energie');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_vehicule');
        $this->addSql('DROP TABLE produit_energie');
        $this->addSql('DROP TABLE vehicule');

    }
}
