<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200908084200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Datos estaticos y de ejemplo para la aplicacion';
    }

    public function up(Schema $schema) : void
    {
        //Usuarios por defecto
        $this->addSql('INSERT INTO usuario (id, nombre, contrasenia) VALUES '
                        .' (NULL, \'Admin\',\'81dc9bdb52d04dc20036dbd8313ed055\')'
                        .',(NULL, \'Ani\',\'d82c8d1619ad8176d665453cfb2e55f0\')'
        );

        //Tipos de plato por defecto
        $this->addSql('INSERT INTO tipo_plato (id, nombre) VALUES '
                        .' (1, \'Desayuno\')'
                        .',(2, \'Comida\')'
                        .',(3, \'Cena\')'
                        .',(4, \'Postre\')'
        );

        //Lista de Alergenos
        $this->addSql('INSERT INTO alergenos (id, nombre, imagen) VALUES '
                        .' ( 1, \'altramuces\', \'altramuces.png\')'
                        .',( 2, \'apio\', \'apio.png\')'
                        .',( 3, \'cacahuetes\', \'cacahuetes.png\')'
                        .',( 4, \'frutos_secos\', \'frutos_secos.png\')'
                        .',( 5, \'gluten\', \'gluten.png\')'
                        .',( 6, \'huevos\', \'huevos.png\')'
                        .',( 7, \'lacteos\', \'lacteos.png\')'
                        .',( 8, \'marisco\', \'marisco.png\')'
                        .',( 9, \'moluscos\', \'moluscos.png\')'
                        .',( 10, \'mostaza\', \'mostaza.png\')'
                        .',( 11, \'pescado\', \'pescado.png\')'
                        .',( 12, \'sesamo\', \'sesamo.png\')'
                        .',( 13, \'soja\', \'soja.png\')'
                        .',( 14, \'sulfitos\', \'sulfitos.png\')'
        );
 
        //Lista de Platos
        $this->addSql('INSERT INTO plato (id, tipo, nombre, calorias) VALUES '
                        .' (NULL, 2, \'Tortilla amarilla\', 41 )'
                        .',(NULL, 2, \'Croquetas caseras\', 605 )'
                        .',(NULL, 4, \'Tarta de queso\', 321 )'
                        .',(NULL, 4, \'Cafe\', 9 )'
                        .',(NULL, 2, \'Arroz tres delicias\', 299 )'
                        .',(NULL, 4, \'Serradura\', 356 )'
                        .',(NULL, 3, \'Salmón Ahumado\', 117 )'
        );

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM usuario WHEre nombre = \'Admin\'');

    }
}
