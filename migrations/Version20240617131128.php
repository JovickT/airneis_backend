<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240617131128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD materiaux INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C97C56625 FOREIGN KEY (materiaux) REFERENCES materiaux (id_materiel)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C97C56625 ON produits (materiaux)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C97C56625');
        $this->addSql('DROP INDEX IDX_BE2DDF8C97C56625 ON produits');
        $this->addSql('ALTER TABLE produits DROP materiaux');
    }
}
