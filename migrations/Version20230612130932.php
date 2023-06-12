<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612130932 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'F1-Ajout Timestampable';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD updateTime DATE NOT NULL, ADD createdTime DATE NOT NULL, DROP date_time, CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD date_time DATETIME NOT NULL, DROP updateTime, DROP createdTime, CHANGE description description VARCHAR(255) NOT NULL');
    }
}
