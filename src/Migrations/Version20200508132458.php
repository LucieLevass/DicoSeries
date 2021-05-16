<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200508132458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE serie ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA3A9334989D9B62 ON serie (slug)');
        $this->addSql('ALTER TABLE episode ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA1CDA989D9B62 ON episode (slug)');
        $this->addSql('ALTER TABLE saison ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0D0D586989D9B62 ON saison (slug)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_DDAA1CDA989D9B62 ON episode');
        $this->addSql('ALTER TABLE episode DROP slug');
        $this->addSql('DROP INDEX UNIQ_C0D0D586989D9B62 ON saison');
        $this->addSql('ALTER TABLE saison DROP slug');
        $this->addSql('DROP INDEX UNIQ_AA3A9334989D9B62 ON serie');
        $this->addSql('ALTER TABLE serie DROP slug');
    }
}
