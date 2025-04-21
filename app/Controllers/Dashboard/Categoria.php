<?php

namespace App\Controllers\Dashboard;
//la linea de abajo se importa para que pueda funcionar el app dashboard como se encuentra dentro de una carpeta 
use App\Controllers\BaseController;
use App\Models\CategoriaModel;


class Categoria extends BaseController
{

    public function new()
    {
        echo view('dashboard/Categoria/new');
    }
    public function show($id)
    {
        $categoriaModel = new CategoriaModel();
        //var_dump($peliculaModel->find($id));

        echo view('dashboard/Categoria/show', ['categoria' => $categoriaModel->find($id)]);
    }
    public function create()
    {
        $categoriaModel = new CategoriaModel();
        $categoriaModel->insert([
            'titulo' => $this->request->getpost('titulo')
           

        ]);
        return redirect()->to('dashboard/Categoria/')->with('mensaje','Registro  de manera exitosa');

        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $categoriaModel = new CategoriaModel();

        echo view(
            'dashboard/Categoria/edit',
            ['categoria' => $categoriaModel->find($id)]

        );
    }
    public function update($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
            
        ]);
        return redirect()->to('dashboard/Categoria/')->with('mensaje','Registro actualizado de manera exitosa');

    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoriaModel->delete($id);

        session()->setFlashdata('mensaje','Registro eliminado exitosamente');
       return redirect()->back();
    }

    public function index()
    {
        $categoriaModel = new CategoriaModel();
        //obtener todos los regiustros 

        echo view('dashboard/Categoria/index', ['categoria' => $categoriaModel->findAll()]);
    }
}
