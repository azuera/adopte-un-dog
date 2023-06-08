<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608083429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'C4-Ajout 0 par Defaut pour les booleens';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE breeder CHANGE is_admin is_admin TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE dog CHANGE is_lof is_lof TINYINT(1) DEFAULT 0 NOT NULL, CHANGE is_adopted is_adopted TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE is_sent_by_adopter is_sent_by_adopter TINYINT(1) DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE is_closed is_closed TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message CHANGE is_sent_by_adopter is_sent_by_adopter TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE dog CHANGE is_lof is_lof TINYINT(1) NOT NULL, CHANGE is_adopted is_adopted TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE is_closed is_closed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE breeder CHANGE is_admin is_admin TINYINT(1) NOT NULL');
    }
}
