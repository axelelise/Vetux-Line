<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012063042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prénom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, numero_tel VARCHAR(255) NOT NULL, cctype VARCHAR(255) NOT NULL, ccnumber INT NOT NULL, cvv2 INT NOT NULL, ccexpires VARCHAR(255) NOT NULL, adresse_physique VARCHAR(255) NOT NULL, taille INT NOT NULL, poids DOUBLE PRECISION NOT NULL, vehicule VARCHAR(255) NOT NULL, coordonnées_gps VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, modele VARCHAR(255) NOT NULL, annee INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE vehicule');
    }
}
?>