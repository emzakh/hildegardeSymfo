<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817125650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits ADD saison VARCHAR(255) DEFAULT NULL, ADD cultivation VARCHAR(255) DEFAULT NULL, ADD conservation VARCHAR(255) DEFAULT NULL, ADD apport VARCHAR(255) DEFAULT NULL, ADD vitamine VARCHAR(255) DEFAULT NULL, ADD bebe VARCHAR(255) DEFAULT NULL, ADD nutriscore VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recettes CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP saison, DROP cultivation, DROP conservation, DROP apport, DROP vitamine, DROP bebe, DROP nutriscore');
        $this->addSql('ALTER TABLE recettes CHANGE date date DATE DEFAULT NULL');
    }
}
