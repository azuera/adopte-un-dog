<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230612132104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'F1-Utilisation trait HasCreatedTime';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD created_time DATE NOT NULL, DROP date_time');
        $this->addSql('ALTER TABLE message ADD created_time DATE NOT NULL, DROP date_time');
        $this->addSql('ALTER TABLE offer ADD updated_time DATE NOT NULL, ADD created_time DATE NOT NULL, DROP updateTime, DROP createdTime');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application ADD date_time DATETIME NOT NULL, DROP created_time');
        $this->addSql('ALTER TABLE offer ADD updateTime DATE NOT NULL, ADD createdTime DATE NOT NULL, DROP updated_time, DROP created_time');
        $this->addSql('ALTER TABLE message ADD date_time DATETIME NOT NULL, DROP created_time');
    }
}
