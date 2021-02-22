<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222121856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sollicitatie ADD kandidaat_id INT NOT NULL');
        $this->addSql('ALTER TABLE sollicitatie ADD CONSTRAINT FK_9577817DD714D977 FOREIGN KEY (kandidaat_id) REFERENCES gebruiker (id)');
        $this->addSql('CREATE INDEX IDX_9577817DD714D977 ON sollicitatie (kandidaat_id)');
        $this->addSql('ALTER TABLE vacature ADD bedrijf_id INT NOT NULL');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5740E9210 FOREIGN KEY (bedrijf_id) REFERENCES gebruiker (id)');
        $this->addSql('CREATE INDEX IDX_9E5830F5740E9210 ON vacature (bedrijf_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sollicitatie DROP FOREIGN KEY FK_9577817DD714D977');
        $this->addSql('DROP INDEX IDX_9577817DD714D977 ON sollicitatie');
        $this->addSql('ALTER TABLE sollicitatie DROP kandidaat_id');
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5740E9210');
        $this->addSql('DROP INDEX IDX_9E5830F5740E9210 ON vacature');
        $this->addSql('ALTER TABLE vacature DROP bedrijf_id');
    }
}
