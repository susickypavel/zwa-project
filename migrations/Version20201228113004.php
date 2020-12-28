<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201228113004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE save_file ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE save_file ADD CONSTRAINT FK_F37F8175F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F37F8175F675F31B ON save_file (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE save_file DROP CONSTRAINT FK_F37F8175F675F31B');
        $this->addSql('DROP INDEX IDX_F37F8175F675F31B');
        $this->addSql('ALTER TABLE save_file DROP author_id');
    }
}
