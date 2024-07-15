<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617141048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresses (id_adresse INT AUTO_INCREMENT NOT NULL, pays VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, code_postal VARCHAR(8) NOT NULL, rue VARCHAR(100) NOT NULL, PRIMARY KEY(id_adresse)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrousel (id INT AUTO_INCREMENT NOT NULL, page VARCHAR(50) NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id_categorie INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, PRIMARY KEY(id_categorie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id_client INT AUTO_INCREMENT NOT NULL, id_adresse INT DEFAULT NULL, prenom VARCHAR(40) NOT NULL, nom VARCHAR(40) NOT NULL, email VARCHAR(80) NOT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, telephone VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_C7440455E7927C74 (email), INDEX IDX_C74404551DC2A166 (id_adresse), PRIMARY KEY(id_client)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id_image INT AUTO_INCREMENT NOT NULL, lien VARCHAR(255) NOT NULL, PRIMARY KEY(id_image)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_carousel (id INT AUTO_INCREMENT NOT NULL, carrousel_id INT NOT NULL, image_id INT NOT NULL, rang INT NOT NULL, INDEX IDX_9227C9A81AA511C9 (carrousel_id), INDEX IDX_9227C9A83DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_produit (id_image_produit INT AUTO_INCREMENT NOT NULL, id_image_id INT NOT NULL, id_produit_id INT NOT NULL, INDEX IDX_BCB5BBFB6D7EC9F8 (id_image_id), INDEX IDX_BCB5BBFBAABEFE2C (id_produit_id), PRIMARY KEY(id_image_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marques (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux (id_materiel INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id_materiel)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id_produit INT AUTO_INCREMENT NOT NULL, marque INT DEFAULT NULL, categorie INT DEFAULT NULL, materiaux INT DEFAULT NULL, reference VARCHAR(15) NOT NULL, nom VARCHAR(100) NOT NULL, prix DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, date_creation DATE NOT NULL, INDEX IDX_BE2DDF8C5A6F91CE (marque), INDEX IDX_BE2DDF8C497DD634 (categorie), INDEX IDX_BE2DDF8C97C56625 (materiaux), PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404551DC2A166 FOREIGN KEY (id_adresse) REFERENCES adresses (id_adresse)');
        $this->addSql('ALTER TABLE image_carousel ADD CONSTRAINT FK_9227C9A81AA511C9 FOREIGN KEY (carrousel_id) REFERENCES carrousel (id)');
        $this->addSql('ALTER TABLE image_carousel ADD CONSTRAINT FK_9227C9A83DA5256D FOREIGN KEY (image_id) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT FK_BCB5BBFB6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE image_produit ADD CONSTRAINT FK_BCB5BBFBAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produits (id_produit)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C5A6F91CE FOREIGN KEY (marque) REFERENCES marques (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C497DD634 FOREIGN KEY (categorie) REFERENCES categories (id_categorie)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C97C56625 FOREIGN KEY (materiaux) REFERENCES materiaux (id_materiel)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404551DC2A166');
        $this->addSql('ALTER TABLE image_carousel DROP FOREIGN KEY FK_9227C9A81AA511C9');
        $this->addSql('ALTER TABLE image_carousel DROP FOREIGN KEY FK_9227C9A83DA5256D');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY FK_BCB5BBFB6D7EC9F8');
        $this->addSql('ALTER TABLE image_produit DROP FOREIGN KEY FK_BCB5BBFBAABEFE2C');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C5A6F91CE');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C497DD634');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C97C56625');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE carrousel');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_carousel');
        $this->addSql('DROP TABLE image_produit');
        $this->addSql('DROP TABLE marques');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
