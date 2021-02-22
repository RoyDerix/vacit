<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222120614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vacature (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, platform_id INT NOT NULL, titel VARCHAR(255) NOT NULL, standplaats VARCHAR(255) NOT NULL, vacature_beschrijving VARCHAR(1500) NOT NULL, plaatsings_datum DATETIME NOT NULL, INDEX IDX_9E5830F5B3E9C81 (niveau_id), INDEX IDX_9E5830F5FFE6496F (platform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_platform (id)');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5FFE6496F FOREIGN KEY (platform_id) REFERENCES niveau_platform (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vacature');
    }
}
