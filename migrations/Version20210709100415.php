<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210709100415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD klant_id INT NOT NULL');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517443C427B2F FOREIGN KEY (klant_id) REFERENCES klant (id)');
        $this->addSql('CREATE INDEX IDX_906517443C427B2F ON invoice (klant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517443C427B2F');
        $this->addSql('DROP INDEX IDX_906517443C427B2F ON invoice');
        $this->addSql('ALTER TABLE invoice DROP klant_id');
    }
}
