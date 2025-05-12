<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Imagenes extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'int',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'imagen' => [
                    'type' => 'varchar',
                    'constraint' => 255,

                ],
                'extension' => [
                    'type' => 'varchar',
                    'constraint' => 255,

                ],
                'data' => [
                    'type' => 'varchar',
                    'constraint' => 555,

                ]

            ]
        );
        $this->forge->addKey('id');
        $this->forge->createTable('imagenes');
    }

    public function down()
    {
        $this->forge->dropTable('imagenes');
    }
}
