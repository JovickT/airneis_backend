<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240818082014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrousel_images (carrousel_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_B6396D71AA511C9 (carrousel_id), INDEX IDX_B6396D73DA5256D (image_id), PRIMARY KEY(carrousel_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrousel_images ADD CONSTRAINT FK_B6396D71AA511C9 FOREIGN KEY (carrousel_id) REFERENCES carrousel (id)');
        $this->addSql('ALTER TABLE carrousel_images ADD CONSTRAINT FK_B6396D73DA5256D FOREIGN KEY (image_id) REFERENCES image (id_image)');
        $this->addSql('ALTER TABLE carrousel ADD nom VARCHAR(255) NOT NULL, DROP page, CHANGE quantite rang INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrousel_images DROP FOREIGN KEY FK_B6396D71AA511C9');
        $this->addSql('ALTER TABLE carrousel_images DROP FOREIGN KEY FK_B6396D73DA5256D');
        $this->addSql('DROP TABLE carrousel_images');
        $this->addSql('ALTER TABLE carrousel ADD page VARCHAR(50) NOT NULL, DROP nom, CHANGE rang quantite INT NOT NULL');
    }
}
