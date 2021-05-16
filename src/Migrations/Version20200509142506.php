<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200509142506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom_pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, nom_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE episode ADD resume LONGTEXT DEFAULT NULL, ADD date_diff_vo DATE NOT NULL, ADD date_diff_vf DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE saison ADD description LONGTEXT DEFAULT NULL, ADD annee_deb INT NOT NULL, ADD annee_fin INT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD status_id INT DEFAULT NULL, ADD pays_id INT DEFAULT NULL, ADD annee_deb INT NOT NULL, ADD annee_fin INT NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A93346BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_AA3A93346BF700BD ON serie (status_id)');
        $this->addSql('CREATE INDEX IDX_AA3A9334A6E44244 ON serie (pays_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334A6E44244');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A93346BF700BD');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE status');
        $this->addSql('ALTER TABLE episode DROP resume, DROP date_diff_vo, DROP date_diff_vf');
        $this->addSql('ALTER TABLE saison DROP description, DROP annee_deb, DROP annee_fin');
        $this->addSql('DROP INDEX IDX_AA3A93346BF700BD ON serie');
        $this->addSql('DROP INDEX IDX_AA3A9334A6E44244 ON serie');
        $this->addSql('ALTER TABLE serie DROP status_id, DROP pays_id, DROP annee_deb, DROP annee_fin, DROP description');
    }
}
