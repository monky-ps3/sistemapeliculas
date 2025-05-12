<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etiquetas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'categoria_id' => [
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => true

            ],
            'titulo' => [
                'type' => 'varchar',
                'constraint' => 255

            ]


        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('categoria_id', 'categorias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('etiquetas');
    }

    public function down()
    {
        $this->forge->dropTable('etiquetas');
    }
}
