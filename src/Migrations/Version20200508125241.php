<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200508125241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, saison_id INT NOT NULL, serie_id INT NOT NULL, num_episode INT NOT NULL, titre_vf VARCHAR(255) NOT NULL, titre_vo VARCHAR(255) NOT NULL, INDEX IDX_DDAA1CDAF965414C (saison_id), INDEX IDX_DDAA1CDAD94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, num_saison INT NOT NULL, INDEX IDX_C0D0D586D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, titre_vf VARCHAR(255) NOT NULL, titre_vo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDAF965414C FOREIGN KEY (saison_id) REFERENCES saison (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDAD94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D586D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDAF965414C');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDAD94388BD');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D586D94388BD');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE serie');
    }
}
