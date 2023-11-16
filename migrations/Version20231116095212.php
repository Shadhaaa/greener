<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116095212 extends AbstractMigration
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
        $this->addSql('CREATE TABLE produit_vehicule (produit_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_30CD0EF347EFB (produit_id), INDEX IDX_30CD0E4A4A3511 (vehicule_id), PRIMARY KEY(produit_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_energie (produit_id INT NOT NULL, energie_id INT NOT NULL, INDEX IDX_E47C51D9F347EFB (produit_id), INDEX IDX_E47C51D9B732A364 (energie_id), PRIMARY KEY(produit_id, energie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, libellet_vehicule VARCHAR(255) DEFAULT NULL, marque_vehicule VARCHAR(255) DEFAULT NULL, pollutio_par_km DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_vehicule ADD CONSTRAINT FK_30CD0EF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_vehicule ADD CONSTRAINT FK_30CD0E4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_energie ADD CONSTRAINT FK_E47C51D9F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_energie ADD CONSTRAINT FK_E47C51D9B732A364 FOREIGN KEY (energie_id) REFERENCES energie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_Commande_Panier');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE evenment');
        $this->addSql('DROP TABLE investissement');
        $this->addSql('DROP TABLE investissment');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE entreprise MODIFY id_entreprise INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP nom, DROP prenom, DROP pdp, DROP num, DROP mail, DROP mdp1, DROP role, DROP adresse, DROP genre, DROP logo, DROP nom_entreprise, DROP secteur, DROP description, CHANGE id_entreprise id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX IDX_29A5EC27CD11A2CF ON produit');
        $this->addSql('ALTER TABLE produit ADD consommation_energie LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD distance_vehicule LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE produits_id entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27A4AEAFEA ON produit (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('CREATE TABLE avis (idAvis INT NOT NULL, detailAvisService VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, noteService INT NOT NULL, id INT NOT NULL, idUser INT NOT NULL, PRIMARY KEY(idAvis)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commande (commande_id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_commande DATE DEFAULT NULL, montant_total DOUBLE PRECISION NOT NULL, adresse_livraison VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_livraison DATE DEFAULT NULL, mode_paiement VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, panierId INT DEFAULT NULL, INDEX FK_Commande_Panier (panierId), PRIMARY KEY(commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaires (id_commentaire INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_post INT NOT NULL, contenu VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, Statut VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_commentaires_post (id_post), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (id_evenement INT AUTO_INCREMENT NOT NULL, id_entreprise INT NOT NULL, id_participant INT NOT NULL, titre_evenement VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_evenement VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, QRcode VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, image_evenement VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, lieu_evenement VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description_evenement VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, liste_participants VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_evenement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenment (id_evenment INT AUTO_INCREMENT NOT NULL, titre VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, lieu VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description_evenment VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, photo VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, id_participant INT NOT NULL, id_entreprise INT NOT NULL, QRcode VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, liste_participant VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_evenment)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE investissement (id_investissement INT AUTO_INCREMENT NOT NULL, id_investisseur INT NOT NULL, id_entreprise INT NOT NULL, montant DOUBLE PRECISION NOT NULL, date_debut_investissement DATE NOT NULL, duree_prevue VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, details VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status INT NOT NULL, PRIMARY KEY(id_investissement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE investissment (id_inv INT AUTO_INCREMENT NOT NULL, montant INT NOT NULL, date_deb_inv INT NOT NULL, status INT NOT NULL, id_entreprise INT NOT NULL, duree_prevue INT NOT NULL, detail INT NOT NULL, id_investisseur INT NOT NULL, PRIMARY KEY(id_inv)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livraison (livraison_id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, coursier_id INT NOT NULL, date_livraison DATE NOT NULL, statut_livraison VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, adresse_livraison VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX commande_id (commande_id), PRIMARY KEY(livraison_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (panierId INT AUTO_INCREMENT NOT NULL, clientId INT DEFAULT NULL, produitId INT DEFAULT NULL, quantite INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, Nomproduit VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX UNIQUE_client_id (clientId), PRIMARY KEY(panierId)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id_post INT AUTO_INCREMENT NOT NULL, id_entreprise INT NOT NULL, titre VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, typeDeContenu VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, contenu VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, image VARCHAR(200) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_post)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (idReclamation INT AUTO_INCREMENT NOT NULL, nom VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci` COMMENT \'il faut sairi @\', screenshot VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, numero_mobile VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_creation DATE NOT NULL, date_traitement DATE NOT NULL, nomServcie VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idReclamation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reponse (idReponse INT NOT NULL, Text VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, status VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idReclamation INT DEFAULT NULL, INDEX idReclamation (idReclamation), PRIMARY KEY(idReponse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id_user INT NOT NULL, nom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, pdp VARCHAR(200) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, num INT DEFAULT NULL, mail VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, mdp1 VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(25) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, adresse VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, genre VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, investisseur_inv LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_Commande_Panier FOREIGN KEY (panierId) REFERENCES panier (panierId)');
        $this->addSql('ALTER TABLE produit_vehicule DROP FOREIGN KEY FK_30CD0EF347EFB');
        $this->addSql('ALTER TABLE produit_vehicule DROP FOREIGN KEY FK_30CD0E4A4A3511');
        $this->addSql('ALTER TABLE produit_energie DROP FOREIGN KEY FK_E47C51D9F347EFB');
        $this->addSql('ALTER TABLE produit_energie DROP FOREIGN KEY FK_E47C51D9B732A364');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE energie');
        $this->addSql('DROP TABLE produit_vehicule');
        $this->addSql('DROP TABLE produit_energie');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE entreprise MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON entreprise');
        $this->addSql('ALTER TABLE entreprise ADD nom VARCHAR(20) DEFAULT NULL, ADD prenom VARCHAR(25) DEFAULT NULL, ADD pdp VARCHAR(200) NOT NULL, ADD num INT NOT NULL, ADD mail VARCHAR(20) NOT NULL, ADD mdp1 VARCHAR(30) NOT NULL, ADD role VARCHAR(20) NOT NULL, ADD adresse VARCHAR(50) NOT NULL, ADD genre VARCHAR(30) NOT NULL, ADD logo VARCHAR(200) NOT NULL, ADD nom_entreprise VARCHAR(20) NOT NULL, ADD secteur VARCHAR(40) NOT NULL, ADD description VARCHAR(30) NOT NULL, CHANGE id id_entreprise INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD PRIMARY KEY (id_entreprise)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A4AEAFEA');
        $this->addSql('DROP INDEX IDX_29A5EC27A4AEAFEA ON produit');
        $this->addSql('ALTER TABLE produit DROP consommation_energie, DROP distance_vehicule, CHANGE entreprise_id produits_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_29A5EC27CD11A2CF ON produit (produits_id)');
    }
}
