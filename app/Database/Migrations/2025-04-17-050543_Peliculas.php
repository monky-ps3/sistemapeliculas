<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peliculas extends Migration
{
    public function up()
    {
 
           $this->forge->addField([
            'id'=>[
                'type'=>'int',
                'constraint'=>5,
                'unsigned'=>true,
                'auto_increment'=>true
            ],
            'categoria_id'=>[
                'type'=>'int',
                'constraint'=>5,
                'unsigned'=>true
                
            ],
            'titulo'=>[
                'type'=>'varchar',
                'constraint'=>255
              
            ],
            'descripcion'=>[
                'type'=>'text',
                'null'=>true
              
            ]


        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('categoria_id','categorias','id','CASCADE','CASCADE');
        $this->forge->createTable('peliculas');
    }

    public function down()
    {
        $this->forge->dropTable('peliculas');
    }
}
