<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616140953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice ADD meldcode INT NOT NULL, ADD garantie VARCHAR(255) DEFAULT NULL, ADD afleveringsbeurt VARCHAR(255) DEFAULT NULL, ADD inruil VARCHAR(255) DEFAULT NULL, ADD inruilprijs VARCHAR(255) DEFAULT NULL, ADD subtotaal VARCHAR(255) NOT NULL, ADD totaal VARCHAR(255) NOT NULL, ADD opmerking VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP meldcode, DROP garantie, DROP afleveringsbeurt, DROP inruil, DROP inruilprijs, DROP subtotaal, DROP totaal, DROP opmerking');
    }
}
