<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240730085457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD id_payment_method INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D46071CF0 FOREIGN KEY (id_payment_method) REFERENCES payment_method (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D46071CF0 ON commande (id_payment_method)');
        $this->addSql('ALTER TABLE payment_method CHANGE client_id client_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment_method CHANGE client_id client_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D46071CF0');
        $this->addSql('DROP INDEX IDX_6EEAA67D46071CF0 ON commande');
        $this->addSql('ALTER TABLE commande DROP id_payment_method');
    }
}
