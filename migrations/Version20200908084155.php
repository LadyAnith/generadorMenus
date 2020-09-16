<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */

final class Version20200908084155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Creación de la estructura de tablas de la BBDD';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL UNIQUE, contrasenia VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_plato (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plato (id INT AUTO_INCREMENT NOT NULL, tipo INT DEFAULT NULL, nombre VARCHAR(50) NOT NULL, calorias DOUBLE PRECISION NOT NULL, INDEX IDX_914B3E45702D1D47 (tipo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alergenos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, imagen VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plato_alergenos (plato_id INT NOT NULL, alergenos_id INT NOT NULL, INDEX IDX_154F3317B0DB09EF (plato_id), INDEX IDX_154F3317B1C19196 (alergenos_id), PRIMARY KEY(plato_id, alergenos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plato ADD CONSTRAINT FK_914B3E45702D1D47 FOREIGN KEY (tipo) REFERENCES tipo_plato (id)');
        $this->addSql('ALTER TABLE plato_alergenos ADD CONSTRAINT FK_154F3317B0DB09EF FOREIGN KEY (plato_id) REFERENCES plato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plato_alergenos ADD CONSTRAINT FK_154F3317B1C19196 FOREIGN KEY (alergenos_id) REFERENCES alergenos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plato_alergenos DROP FOREIGN KEY FK_154F3317B1C19196');
        $this->addSql('ALTER TABLE plato_alergenos DROP FOREIGN KEY FK_154F3317B0DB09EF');
        $this->addSql('ALTER TABLE plato DROP FOREIGN KEY FK_914B3E45702D1D47');
        $this->addSql('DROP TABLE alergenos');
        $this->addSql('DROP TABLE plato');
        $this->addSql('DROP TABLE plato_alergenos');
        $this->addSql('DROP TABLE tipo_plato');
        $this->addSql('DROP TABLE usuario');
    }
}
