<?php


namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function new()
    {
        echo view('dashboard/pelicula/new');
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        //var_dump($peliculaModel->find($id));

        echo view('dashboard/pelicula/show', ['pelicula' => $peliculaModel->find($id)]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->insert([
            'titulo' => $this->request->getpost('titulo'),
            'descripcion' => $this->request->getpost('descripcion')

        ]);
        //sistemapeliculas/dashboard/Pelicula
        //dashboard/pelicula/index
        //ROUTES  REDIRECCIONA A dashboard/Pelicula           Handler      | »    | \App\Controllers\Dashboard\Pelicula::index 
        return redirect()->to('dashboard/Pelicula/')->with('mensaje','Registro gstionado de manera exitosa');
        //echo 'creado';
        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        echo view(
            'dashboard/pelicula/edit',
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
        return redirect()->to('dashboard/Pelicula/')->with('mensaje','Registro actualizado de manera exitosa');
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);
        session()->setFlashdata('mensaje','Registro eliminado exitosamente');
        return redirect()->back();
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();
        //obtener todos los regiustros 

        echo view('dashboard/pelicula/index', ['peliculas' => $peliculaModel->findAll()]);
    }
}
