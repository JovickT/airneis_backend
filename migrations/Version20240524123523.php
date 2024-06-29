<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524123523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY adresse_client_ibfk_1');
        $this->addSql('ALTER TABLE adresse_client DROP FOREIGN KEY adresse_client_ibfk_2');
        $this->addSql('ALTER TABLE client_paiement DROP FOREIGN KEY client_paiement_ibfk_1');
        $this->addSql('ALTER TABLE client_paiement DROP FOREIGN KEY client_paiement_ibfk_2');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY commandes_ibfk_1');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY commandes_ibfk_2');
        $this->addSql('ALTER TABLE materiaux_produit DROP FOREIGN KEY materiaux_produit_ibfk_1');
        $this->addSql('ALTER TABLE materiaux_produit DROP FOREIGN KEY materiaux_produit_ibfk_2');
        $this->addSql('ALTER TABLE contenu_commande DROP FOREIGN KEY contenu_commande_ibfk_1');
        $this->addSql('ALTER TABLE contenu_commande DROP FOREIGN KEY contenu_commande_ibfk_2');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY produit_panier_ibfk_1');
        $this->addSql('ALTER TABLE produit_panier DROP FOREIGN KEY produit_panier_ibfk_2');
        $this->addSql('DROP TABLE adresse_client');
        $this->addSql('DROP TABLE client_paiement');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE materiaux_produit');
        $this->addSql('DROP TABLE contenu_commande');
        $this->addSql('DROP TABLE produit_panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('ALTER TABLE adresses CHANGE rue rue VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE mot_de_passe mot_de_passe VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(15) NOT NULL, CHANGE id_adresse id_adresse INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404551DC2A166 FOREIGN KEY (id_adresse) REFERENCES adresses (id_adresse)');
        $this->addSql('ALTER TABLE client RENAME INDEX email TO UNIQ_C7440455E7927C74');
        $this->addSql('ALTER TABLE client RENAME INDEX id_adresse TO IDX_C74404551DC2A166');
        $this->addSql('ALTER TABLE image CHANGE lien lien VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY image_produit_ibfk_1');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY image_produit_ibfk_2');
        $this->addSql('DROP INDEX id_image ON image_produit');
        $this->addSql('DROP INDEX id_produit ON image_produit');
        $this->addSql('ALTER TABLE image_produit ADD id_image_id INT NOT NULL, ADD id_produit_id INT NOT NULL, DROP id_image, DROP id_produit');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT FK_BCB5BBFB6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT FK_BCB5BBFBAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produits (id_produit)');
        $this->addSql('CREATE INDEX IDX_BCB5BBFB6D7EC9F8 ON image_produit (id_image_id)');
        $this->addSql('CREATE INDEX IDX_BCB5BBFBAABEFE2C ON image_produit (id_produit_id)');
        $this->addSql('ALTER TABLE materiaux CHANGE nom nom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY produits_ibfk_1');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY produits_ibfk_2');
        $this->addSql('ALTER TABLE produits CHANGE marque marque INT DEFAULT NULL, CHANGE categorie categorie INT DEFAULT NULL, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C5A6F91CE FOREIGN KEY (marque) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C497DD634 FOREIGN KEY (categorie) REFERENCES categories (id_categorie)');
        $this->addSql('ALTER TABLE produits RENAME INDEX marque TO IDX_BE2DDF8C5A6F91CE');
        $this->addSql('ALTER TABLE produits RENAME INDEX categorie TO IDX_BE2DDF8C497DD634');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_client (id_adresse_utilisateur INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, id_adresse INT NOT NULL, INDEX id_adresse (id_adresse), INDEX id_utilisateur (id_client), PRIMARY KEY(id_adresse_utilisateur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client_paiement (id_utilisateur_paiement INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, id_paiement INT NOT NULL, INDEX id_paiement (id_paiement), INDEX id_utilisateur (id_client), PRIMARY KEY(id_utilisateur_paiement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etat (id_etat INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id_etat)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE paiement (id_paiement INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, numero_carte VARCHAR(25) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, date_expiration DATE NOT NULL, cvv INT NOT NULL, PRIMARY KEY(id_paiement)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commandes (id_commande INT AUTO_INCREMENT NOT NULL, id_client INT NOT NULL, id_etat INT NOT NULL, reference VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, prix_total DOUBLE PRECISION NOT NULL, date_creation DATE NOT NULL, INDEX id_client (id_client), INDEX id_etat (id_etat), UNIQUE INDEX reference (reference), PRIMARY KEY(id_commande)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE materiaux_produit (id_matiere_produit INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_matiere INT NOT NULL, INDEX id_matiere (id_matiere), INDEX id_produit (id_produit), PRIMARY KEY(id_matiere_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contenu_commande (id_contenu INT AUTO_INCREMENT NOT NULL, id_commande INT NOT NULL, id_produit INT NOT NULL, INDEX id_commande (id_commande), INDEX id_produit (id_produit), PRIMARY KEY(id_contenu)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit_panier (id_panier_produit INT AUTO_INCREMENT NOT NULL, id_produit INT NOT NULL, id_panier INT NOT NULL, INDEX id_panier (id_panier), INDEX id_prouit (id_produit), PRIMARY KEY(id_panier_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE panier (id_panier INT AUTO_INCREMENT NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, PRIMARY KEY(id_panier)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT adresse_client_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id_client) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE adresse_client ADD CONSTRAINT adresse_client_ibfk_2 FOREIGN KEY (id_adresse) REFERENCES adresses (id_adresse) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE client_paiement ADD CONSTRAINT client_paiement_ibfk_1 FOREIGN KEY (id_client) REFERENCES client (id_client) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE client_paiement ADD CONSTRAINT client_paiement_ibfk_2 FOREIGN KEY (id_paiement) REFERENCES paiement (id_paiement) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT commandes_ibfk_1 FOREIGN KEY (id_etat) REFERENCES etat (id_etat) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT commandes_ibfk_2 FOREIGN KEY (id_client) REFERENCES client (id_client) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE materiaux_produit ADD CONSTRAINT materiaux_produit_ibfk_1 FOREIGN KEY (id_matiere) REFERENCES materiaux (id_materiel) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE materiaux_produit ADD CONSTRAINT materiaux_produit_ibfk_2 FOREIGN KEY (id_produit) REFERENCES produits (id_produit) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contenu_commande ADD CONSTRAINT contenu_commande_ibfk_1 FOREIGN KEY (id_commande) REFERENCES commandes (id_commande) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE contenu_commande ADD CONSTRAINT contenu_commande_ibfk_2 FOREIGN KEY (id_produit) REFERENCES produits (id_produit) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT produit_panier_ibfk_1 FOREIGN KEY (id_produit) REFERENCES produits (id_produit) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produit_panier ADD CONSTRAINT produit_panier_ibfk_2 FOREIGN KEY (id_panier) REFERENCES panier (id_panier) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C5A6F91CE');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C497DD634');
        $this->addSql('ALTER TABLE produits CHANGE marque marque INT NOT NULL, CHANGE categorie categorie INT NOT NULL, CHANGE description description VARCHAR(1000) NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT produits_ibfk_1 FOREIGN KEY (categorie) REFERENCES categories (id_categorie) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT produits_ibfk_2 FOREIGN KEY (marque) REFERENCES marques (id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE produits RENAME INDEX idx_be2ddf8c497dd634 TO categorie');
        $this->addSql('ALTER TABLE produits RENAME INDEX idx_be2ddf8c5a6f91ce TO marque');
        $this->addSql('ALTER TABLE adresses CHANGE rue rue VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY FK_BCB5BBFB6D7EC9F8');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY FK_BCB5BBFBAABEFE2C');
        $this->addSql('DROP INDEX IDX_BCB5BBFB6D7EC9F8 ON image_produit');
        $this->addSql('DROP INDEX IDX_BCB5BBFBAABEFE2C ON image_produit');
        $this->addSql('ALTER TABLE image_produit ADD id_image INT NOT NULL, ADD id_produit INT NOT NULL, DROP id_image_id, DROP id_produit_id');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT image_produit_ibfk_1 FOREIGN KEY (id_produit) REFERENCES produits (id_produit) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT image_produit_ibfk_2 FOREIGN KEY (id_image) REFERENCES image (id_image) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX id_image ON image_produit (id_image)');
        $this->addSql('CREATE INDEX id_produit ON image_produit (id_produit)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404551DC2A166');
        $this->addSql('ALTER TABLE client CHANGE id_adresse id_adresse INT NOT NULL, CHANGE roles roles JSON DEFAULT NULL, CHANGE mot_de_passe mot_de_passe VARCHAR(40) NOT NULL, CHANGE telephone telephone VARCHAR(15) DEFAULT NULL');
        $this->addSql('ALTER TABLE client RENAME INDEX uniq_c7440455e7927c74 TO email');
        $this->addSql('ALTER TABLE client RENAME INDEX idx_c74404551dc2a166 TO id_adresse');
        $this->addSql('ALTER TABLE image CHANGE lien lien VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE materiaux CHANGE nom nom VARCHAR(30) NOT NULL');
    }
}
