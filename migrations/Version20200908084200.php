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
                        .' (NULL, \'Admin\',\'$argon2id$v=19$m=65536,t=4,p=1$ZDd5ZjczN0lQZDVlU2RYVg$FDAEWNY6FYQy69f4W7yeg8fhLBsTiasrlRJBwmoyA7E\')'
                        .',(NULL, \'Ani\',\'$argon2id$v=19$m=65536,t=4,p=1$eUg2bWEzMVRrNEQyTFcydg$pEQdZmSVfcgR5Bd/zdEnGFQSKE9TMp36AIeC1v2umso\')'
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
                        .',( 4, \'frutos secos\', \'frutos_secos.png\')'
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
                        .' (NULL, 2, \'Tortilla de Patatas\', 126 )'
                        .',(NULL, 2, \'Croquetas Caseras\', 255 )'
                        .',(NULL, 4, \'Tarta de queso\', 321 )'
                        .',(NULL, 1, \'Cafe\', 9 )'
                        .',(NULL, 2, \'Arroz tres delicias\', 299 )'
                        .',(NULL, 4, \'Serradura\', 356 )'
                        .',(NULL, 3, \'Salmón a la naranja\', 244 )'
                        .',(NULL, 1, \'Tostadas con mermelada\', 211 )'
                        .',(NULL, 2, \'Paella\', 379 )'
                        .',(NULL, 3, \'Sushi\', 50 )'
                        .',(NULL, 2, \'Cordero Asado\', 266 )'
                        .',(NULL, 4, \'Coulant de chocolate\', 384 )'
                        .',(NULL, 4, \'Yogurt\', 54 )'
                        .',(NULL, 1, \'Chocolate con churros\', 190 )'
                        .',(NULL, 1, \'Leche con ColaCao\', 92 )'
                        .',(NULL, 4, \'Natillas\', 95 )'
                        .',(NULL, 3, \'Hamburguesa\', 295 )'
                        .',(NULL, 3, \'Emperador a la plancha\', 172 )'
                        .',(NULL, 1, \'Pancakes\', 351 )'
                        .',(NULL, 3, \'Ensalada Caprese\', 117 )'
        );

        
        //Lista de platos con su alérgenos
        $this->addSql('INSERT INTO plato_alergenos (plato_id, alergenos_id) VALUES '
                        .' (1, 6)'
                        .',(2, 5)'
                        .',(2, 6)'
                        .',(2, 7)'
                        .',(3, 5)'
                        .',(3, 6)'
                        .',(3, 7)'
                        .',(4, 7)'
                        .',(5, 5)'
                        .',(5, 6)'
                        .',(5, 8)'
                        .',(5, 11)'
                        .',(5, 13)'
                        .',(6, 5)'
                        .',(6, 7)'
                        .',(7, 11)'
                        .',(7, 13)'
                        .',(8, 5)'
                        .',(9, 5)'
                        .',(9, 9)'
                        .',(9, 8)'
                        .',(9, 11)'
                        .',(10, 5)'
                        .',(10, 13)'
                        .',(10, 8)'
                        .',(10, 11)'
                        .',(10, 12)'
                        .',(11, 5)'
                        .',(11, 14)'
                        .',(12, 3)'
                        .',(12, 5)'
                        .',(12, 6)'
                        .',(12, 7)'
                        .',(13, 7)'
                        .',(14, 5)'
                        .',(14, 7)'
                        .',(15, 4)'
                        .',(15, 7)'
                        .',(16, 6)'
                        .',(16, 7)'
                        .',(17, 5)'
                        .',(17, 6)'
                        .',(17, 10)'
                        .',(17, 12)'
                        .',(17, 14)'
                        .',(18, 11)'
                        .',(18, 13)'
                        .',(19, 5)'
                        .',(19, 6)'
                        .',(19, 7)'
                        .',(20, 4)'
                        .',(20, 7)'
                        
        );

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM usuario WHEre nombre = \'Admin\'');

    }
}
