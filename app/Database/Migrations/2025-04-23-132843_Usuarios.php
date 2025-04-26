<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuarios extends Migration
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
            'usuario' => [
                'type' => 'varchar',
                'constraint' => 100,
                'unique' => true,

            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 100,
                'unique' => true,

            ],
            'contrasena' => [
                'type' => 'varchar',
                'constraint' => 300,
                'unique' => true,
            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'regular'],
                'default' => 'regular',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        //
        $this->forge->dropTable('usuarios');
    }
}
