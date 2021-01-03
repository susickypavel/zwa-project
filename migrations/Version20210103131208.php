<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103131208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE world_upload ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE world_upload ADD CONSTRAINT FK_87839B5CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_87839B5CF675F31B ON world_upload (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE world_upload DROP CONSTRAINT FK_87839B5CF675F31B');
        $this->addSql('DROP INDEX IDX_87839B5CF675F31B');
        $this->addSql('ALTER TABLE world_upload DROP author_id');
    }
}
