<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210415171441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad ADD picture_id INT NOT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('CREATE INDEX IDX_77E0ED58EE45BDBF ON ad (picture_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58EE45BDBF');
        $this->addSql('DROP INDEX IDX_77E0ED58EE45BDBF ON ad');
        $this->addSql('ALTER TABLE ad DROP picture_id');
    }
}
