<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {

        $peliculaModel = new PeliculaModel();
        $categoriasModel = new CategoriaModel();
        $categorias=$categoriasModel->limit(7)->findAll();

        $peliculaModel->where('id>=', 1)->delete();
        foreach ($categorias as $c) {
            for ($i = 0; $i < 20; $i++) {
                $peliculaModel->table('peliculas')->insert(
                    [
                        'titulo' => "pelicula $i",
                        'categoria_id' => $c->id,
                        'descripcion' => "En Filmin usamos cookies para el funcionamiento del sitio web, 
                    para mejorar y personalizar la experiencia de usuario y para recopilar"
                    ]
                );
            }
        }
    }
}
