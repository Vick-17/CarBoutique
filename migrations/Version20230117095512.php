<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117095512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annees (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_voiture (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, marque_id INT NOT NULL, modele_id INT NOT NULL, transmission_id INT NOT NULL, porte_id INT NOT NULL, place_id INT NOT NULL, energie_id INT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_name VARCHAR(255) NOT NULL, imaged VARCHAR(255) NOT NULL, imaget VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, description_longue LONGTEXT NOT NULL, annee VARCHAR(255) NOT NULL, km VARCHAR(255) NOT NULL, puissance_cv VARCHAR(255) NOT NULL, puissance_din VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, INDEX IDX_430C5B8A76ED395 (user_id), INDEX IDX_430C5B84827B9B2 (marque_id), INDEX IDX_430C5B8AC14B70A (modele_id), INDEX IDX_430C5B878D28519 (transmission_id), INDEX IDX_430C5B86BCC8323 (porte_id), INDEX IDX_430C5B8DA6A219 (place_id), INDEX IDX_430C5B8B732A364 (energie_id), INDEX IDX_430C5B8C54C8C93 (type_id), FULLTEXT INDEX article (title, description), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE energie (id INT AUTO_INCREMENT NOT NULL, carburant VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exemple (id INT AUTO_INCREMENT NOT NULL, field_exemple VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE km (id INT AUTO_INCREMENT NOT NULL, nbr_de_km VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_news (id INT AUTO_INCREMENT NOT NULL, email_user VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, marc_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_100285584827B9B2 (marque_id), INDEX IDX_100285588724D9C4 (marc_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, nbr_de_place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE porte (id INT AUTO_INCREMENT NOT NULL, nbr_de_porte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclam (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, object VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_8141D8FEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transmission (id INT AUTO_INCREMENT NOT NULL, boite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, vehicule_type VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_article_voiture (user_id INT NOT NULL, article_voiture_id INT NOT NULL, INDEX IDX_16ECA937A76ED395 (user_id), INDEX IDX_16ECA9373D58793B (article_voiture_id), PRIMARY KEY(user_id, article_voiture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, INDEX IDX_292FFF1D4827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B84827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B8AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B878D28519 FOREIGN KEY (transmission_id) REFERENCES transmission (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B86BCC8323 FOREIGN KEY (porte_id) REFERENCES porte (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B8DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B8B732A364 FOREIGN KEY (energie_id) REFERENCES energie (id)');
        $this->addSql('ALTER TABLE article_voiture ADD CONSTRAINT FK_430C5B8C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285584827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_100285588724D9C4 FOREIGN KEY (marc_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE reclam ADD CONSTRAINT FK_8141D8FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_article_voiture ADD CONSTRAINT FK_16ECA937A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_article_voiture ADD CONSTRAINT FK_16ECA9373D58793B FOREIGN KEY (article_voiture_id) REFERENCES article_voiture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B8A76ED395');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B84827B9B2');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B8AC14B70A');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B878D28519');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B86BCC8323');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B8DA6A219');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B8B732A364');
        $this->addSql('ALTER TABLE article_voiture DROP FOREIGN KEY FK_430C5B8C54C8C93');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285584827B9B2');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_100285588724D9C4');
        $this->addSql('ALTER TABLE reclam DROP FOREIGN KEY FK_8141D8FEA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user_article_voiture DROP FOREIGN KEY FK_16ECA937A76ED395');
        $this->addSql('ALTER TABLE user_article_voiture DROP FOREIGN KEY FK_16ECA9373D58793B');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D4827B9B2');
        $this->addSql('DROP TABLE annees');
        $this->addSql('DROP TABLE article_voiture');
        $this->addSql('DROP TABLE energie');
        $this->addSql('DROP TABLE exemple');
        $this->addSql('DROP TABLE km');
        $this->addSql('DROP TABLE mail_news');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE porte');
        $this->addSql('DROP TABLE reclam');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE transmission');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_article_voiture');
        $this->addSql('DROP TABLE vehicule');
    }
}
