<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515144452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_DDAA1CDA989D9B62 ON episode');
        $this->addSql('ALTER TABLE episode CHANGE slug slug_episode VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA1CDA966D11EB ON episode (slug_episode)');
        $this->addSql('DROP INDEX UNIQ_C0D0D586989D9B62 ON saison');
        $this->addSql('ALTER TABLE saison CHANGE slug slug_saison VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0D0D586309A3A3 ON saison (slug_saison)');
        $this->addSql('DROP INDEX UNIQ_AA3A9334989D9B62 ON serie');
        $this->addSql('ALTER TABLE serie CHANGE slug slug_serie VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA3A93347FC217C9 ON serie (slug_serie)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_DDAA1CDA966D11EB ON episode');
        $this->addSql('ALTER TABLE episode CHANGE slug_episode slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDAA1CDA989D9B62 ON episode (slug)');
        $this->addSql('DROP INDEX UNIQ_C0D0D586309A3A3 ON saison');
        $this->addSql('ALTER TABLE saison CHANGE slug_saison slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0D0D586989D9B62 ON saison (slug)');
        $this->addSql('DROP INDEX UNIQ_AA3A93347FC217C9 ON serie');
        $this->addSql('ALTER TABLE serie CHANGE slug_serie slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AA3A9334989D9B62 ON serie (slug)');
    }
}
