<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607131524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'C2-Creation des entites et initialisation de la BDD';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, offer_id INT NOT NULL, date_time DATETIME NOT NULL, INDEX IDX_A45BDDC1A76ED395 (user_id), INDEX IDX_A45BDDC153C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breed_dog (breed_id INT NOT NULL, dog_id INT NOT NULL, INDEX IDX_7AEFF8DCA8B4A30F (breed_id), INDEX IDX_7AEFF8DC634DFEB (dog_id), PRIMARY KEY(breed_id, dog_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE breeder (id INT NOT NULL, is_admin TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog (id INT AUTO_INCREMENT NOT NULL, offer_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, is_lof TINYINT(1) NOT NULL, history LONGTEXT NOT NULL, sociability LONGTEXT NOT NULL, is_adopted TINYINT(1) NOT NULL, INDEX IDX_812C397D53C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dog_application (dog_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_376B6DEE634DFEB (dog_id), INDEX IDX_376B6DEE3E030ACD (application_id), PRIMARY KEY(dog_id, application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, dog_id INT NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_C53D045F634DFEB (dog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, application_id INT NOT NULL, text LONGTEXT NOT NULL, date_time DATETIME NOT NULL, is_sent_by_adopter TINYINT(1) NOT NULL, INDEX IDX_B6BD307F3E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, breeder_id INT NOT NULL, title VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_time DATETIME NOT NULL, is_closed TINYINT(1) NOT NULL, INDEX IDX_29D6873E33C95BB1 (breeder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(128) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE breed_dog ADD CONSTRAINT FK_7AEFF8DCA8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breed_dog ADD CONSTRAINT FK_7AEFF8DC634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE breeder ADD CONSTRAINT FK_73DA3D7ABF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog ADD CONSTRAINT FK_812C397D53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE dog_application ADD CONSTRAINT FK_376B6DEE634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dog_application ADD CONSTRAINT FK_376B6DEE3E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F634DFEB FOREIGN KEY (dog_id) REFERENCES dog (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F3E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E33C95BB1 FOREIGN KEY (breeder_id) REFERENCES breeder (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1A76ED395');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC153C674EE');
        $this->addSql('ALTER TABLE breed_dog DROP FOREIGN KEY FK_7AEFF8DCA8B4A30F');
        $this->addSql('ALTER TABLE breed_dog DROP FOREIGN KEY FK_7AEFF8DC634DFEB');
        $this->addSql('ALTER TABLE breeder DROP FOREIGN KEY FK_73DA3D7ABF396750');
        $this->addSql('ALTER TABLE dog DROP FOREIGN KEY FK_812C397D53C674EE');
        $this->addSql('ALTER TABLE dog_application DROP FOREIGN KEY FK_376B6DEE634DFEB');
        $this->addSql('ALTER TABLE dog_application DROP FOREIGN KEY FK_376B6DEE3E030ACD');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F634DFEB');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F3E030ACD');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E33C95BB1');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649AE80F5DF');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE breed_dog');
        $this->addSql('DROP TABLE breeder');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE dog');
        $this->addSql('DROP TABLE dog_application');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
