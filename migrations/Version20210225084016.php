<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225084016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gebruiker CHANGE geboortedatum geboortedatum DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sollicitatie CHANGE uitgenodigd uitgenodigd VARCHAR(255) NOT NULL, CHANGE sollicitatie_datum sollicitatie_datum DATETIME NOT NULL');
        $this->addSql('ALTER TABLE vacature ADD test LONGTEXT DEFAULT NULL, CHANGE vacature_beschrijving vacature_beschrijving VARCHAR(10000) NOT NULL, CHANGE plaatsings_datum plaatsings_datum DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gebruiker CHANGE geboortedatum geboortedatum DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE sollicitatie CHANGE uitgenodigd uitgenodigd VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sollicitatie_datum sollicitatie_datum DATE NOT NULL');
        $this->addSql('ALTER TABLE vacature DROP test, CHANGE vacature_beschrijving vacature_beschrijving TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE plaatsings_datum plaatsings_datum DATE NOT NULL');
    }
}
