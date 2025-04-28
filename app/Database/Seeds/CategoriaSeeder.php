<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        // puedes usuar igual el esquem,a de $categoriaModel new $this->db->table('categorias');
        //$categoriaModel= new CategoriaModel();
        $this->db->table('categorias')->where('id>=',1)->delete();
        for($i=0; $i<20; $i++){
            $this->db->table('categorias')->insert(
                [
                    'titulo' => "categorias $i"
                ]
            );
        }
       
    }
}
