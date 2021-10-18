<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018143157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD num_tel VARCHAR(255) NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL, ADD code_postal VARCHAR(255) NOT NULL, ADD region VARCHAR(255) NOT NULL, ADD véhicule VARCHAR(255) NOT NULL, ADD latitude VARCHAR(255) NOT NULL, ADD longitude VARCHAR(255) NOT NULL, DROP prénom, DROP numero_tel, DROP vehicule, DROP coordonnées_gps, CHANGE date_de_naissance date_de_naissance VARCHAR(255) NOT NULL, CHANGE ccnumber ccnumber VARCHAR(255) NOT NULL, CHANGE cvv2 cvv2 VARCHAR(255) NOT NULL, CHANGE taille taille VARCHAR(255) NOT NULL, CHANGE poids poids VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE client ADD prénom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD numero_tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD vehicule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD coordonnées_gps VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP prenom, DROP email, DROP num_tel, DROP city, DROP state, DROP code_postal, DROP region, DROP véhicule, DROP latitude, DROP longitude, CHANGE date_de_naissance date_de_naissance DATE NOT NULL, CHANGE ccnumber ccnumber INT NOT NULL, CHANGE cvv2 cvv2 INT NOT NULL, CHANGE taille taille INT NOT NULL, CHANGE poids poids DOUBLE PRECISION NOT NULL');
    }
}
