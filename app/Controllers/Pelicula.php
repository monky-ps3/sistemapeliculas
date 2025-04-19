<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function new()
    {
        echo view('pelicula/new');
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        //var_dump($peliculaModel->find($id));

        echo view('pelicula/show', ['pelicula' => $peliculaModel->find($id)]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->insert([
            'titulo' => $this->request->getpost('titulo'),
            'descripcion' => $this->request->getpost('descripcion')

        ]);
        echo 'creado';
        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'pelicula/edit',
            ['pelicula' => $peliculaModel->find($id)]

        );
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);
        echo 'actualizado';
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);
        echo "elimiado";
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();
        //obtener todos los regiustros 

        echo view('pelicula/index', ['peliculas' => $peliculaModel->findAll()]);
    }
}
