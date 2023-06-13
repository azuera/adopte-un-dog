<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613071201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'F1-Changement type DATE en DATETIME';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application CHANGE created_time created_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE dog_application DROP FOREIGN KEY FK_376B6DEE634DFEB');
        $this->addSql('ALTER TABLE dog_application ADD CONSTRAINT FK_376B6DEE634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE message CHANGE created_time created_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE offer CHANGE updated_time updated_time DATETIME NOT NULL, CHANGE created_time created_time DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application CHANGE created_time created_time DATE NOT NULL');
        $this->addSql('ALTER TABLE dog_application DROP FOREIGN KEY FK_376B6DEE634DFEB');
        $this->addSql('ALTER TABLE dog_application ADD CONSTRAINT FK_376B6DEE634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer CHANGE updated_time updated_time DATE NOT NULL, CHANGE created_time created_time DATE NOT NULL');
        $this->addSql('ALTER TABLE message CHANGE created_time created_time DATE NOT NULL');
    }
}
