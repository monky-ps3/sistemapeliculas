<?php

namespace App\Controllers;


use App\Models\CategoriaModel;


class Categoria extends BaseController
{

    public function new()
    {
        echo view('Categoria/new');
    }
    public function show($id)
    {
        $categoriaModel = new CategoriaModel();
        //var_dump($peliculaModel->find($id));

        echo view('Categoria/show', ['categoria' => $categoriaModel->find($id)]);
    }
    public function create()
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->insert([
            'titulo' => $this->request->getpost('titulo')
           

        ]);
        echo 'creado';
        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();

        echo view(
            'Categoria/edit',
            ['categoria' => $categoriaModel->find($id)]

        );
    }
    public function update($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
            
        ]);
        echo 'actualizado';
    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoriaModel->delete($id);
        echo "elimiado";
    }

    public function index()
    {
        $categoriaModel = new CategoriaModel();
        //obtener todos los regiustros 

        echo view('Categoria/index', ['categoria' => $categoriaModel->findAll()]);
    }
}
