<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240525194655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_carousel (id INT AUTO_INCREMENT NOT NULL, carrousel_id INT NOT NULL, image_id INT NOT NULL, rang INT NOT NULL, INDEX IDX_9227C9A81AA511C9 (carrousel_id), INDEX IDX_9227C9A83DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_carousel ADD CONSTRAINT FK_9227C9A81AA511C9 FOREIGN KEY (carrousel_id) REFERENCES carrousel (id)');
        $this->addSql('ALTER TABLE image_carousel ADD CONSTRAINT FK_9227C9A83DA5256D FOREIGN KEY (image_id) REFERENCES image (id_image)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_carousel DROP FOREIGN KEY FK_9227C9A81AA511C9');
        $this->addSql('ALTER TABLE image_carousel DROP FOREIGN KEY FK_9227C9A83DA5256D');
        $this->addSql('DROP TABLE image_carousel');
    }
}
