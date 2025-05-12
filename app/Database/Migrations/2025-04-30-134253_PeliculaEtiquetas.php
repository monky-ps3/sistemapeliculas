<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeliculaEtiquetas extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'pelicula_id' => [
                    'type' => 'int',
                    'constraint' => 5,
                    'unsigned' => true,

                ],
                'etiqueta_id' => [
                    'type' => 'int',
                    'constraint' => 5,
                    'unsigned' => true,

                ]


            ]
        );
        $this->forge->addForeignKey('pelicula_id', 'peliculas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('etiqueta_id', 'etiquetas', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pelicula_etiqueta');
    }

    public function down()
    {
        $this->forge->dropTable('pelicula_etiqueta');
    }
}
