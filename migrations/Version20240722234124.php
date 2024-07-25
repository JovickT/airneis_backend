<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240722234124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD id_adresse INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D1DC2A166 FOREIGN KEY (id_adresse) REFERENCES adresses (id_adresse)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D1DC2A166 ON commande (id_adresse)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D1DC2A166');
        $this->addSql('DROP INDEX IDX_6EEAA67D1DC2A166 ON commande');
        $this->addSql('ALTER TABLE commande DROP id_adresse');
    }
}
