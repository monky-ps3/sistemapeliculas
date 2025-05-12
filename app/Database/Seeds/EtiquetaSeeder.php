<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriasModel = new CategoriaModel();
        $categorias = $categoriasModel->limit(7)->findAll();


         //borrado  de etiquetas
        $etiquetaModel->where('id>=', 1)->delete();
        foreach ($categorias as $c) {
            for ($i = 0; $i < 20; $i++) {
                $etiquetaModel->table('etiquetas')->insert(
                    [
                        'titulo' => "Tag - $i $c->titulo",
                        'categoria_id' => $c->id,
                    
                    ]
                );
            }
        }
    }
}
