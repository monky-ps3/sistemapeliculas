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
        //var_dump($peliculaModel->find($id));  asObject()

        echo view('dashboard/Categoria/show', ['categoria' => $categoriaModel->find($id)]);
    }
    public function create()
    {
        $categoriaModel = new CategoriaModel();
        if ($this->validate('categoriasrules')) {
            $categoriaModel->insert([
                'titulo' => $this->request->getpost('titulo')

            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // var_dump($this->validator->getError('titulo'));
            //redirecciona al mismo formulario 
            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/Categoria/')->with('mensaje', 'Registro  de manera exitosa');
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
        if ($this->validate('categoriasrules')) {
            $categoriaModel->update($id, [
                'titulo' => $this->request->getPost('titulo')

            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // var_dump($this->validator->getError('titulo'));
            //redirecciona al mismo formulario 
            return redirect()->back()->withInput();
        }

        return redirect()->to('dashboard/Categoria/')->with('mensaje', 'Registro actualizado de manera exitosa');
    }
    public function delete($id)
    {
        $categoriaModel = new CategoriaModel();

        $categoriaModel->delete($id);

        //session()->setFlashdata('mensaje', 'Registro eliminado exitosamente');
        //return redirect()->back();
        return redirect()->to('dashboard/Categoria/')->with('mensaje', 'Registro eliminado exitosamente');
    }

    public function index()
    {
        $categoriaModel = new CategoriaModel();
        //obtener todos los regiustros 

        echo view('dashboard/Categoria/index', [
            'categoria' => $categoriaModel->paginate(10),
            'pager'=>$categoriaModel->pager

               // ->findAll()
        ]);
    }
}
