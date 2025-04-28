<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Categoria extends ResourceController
{

    protected $modelName = 'App\Models\CategoriaModel';
    protected $format = 'json';
    //protected $format='xml';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }
    public function show($id = null)
    {
        return $this->respond($this->model->find($id));
    }
    public function create()
    {

        // protected $modelName='App\Models\PeliculaModel'; es lo mismo que $peliculaModel = new PeliculaModel();
        //ya no es necesario solo se utiliza model 
        if ($this->validate('categoriasrules')) {
            $id =  $this->model->insert([
                'titulo' => $this->request->getpost('titulo')
              
            ]);
        } else {

            return $this->respond($this->validator->getErrors(), 400);
        }
        return $this->respond($id);
    }
    public function update($id=null)
    {
        //$peliculaModel = new PeliculaModel();
        if ($this->validate('categoriasrules')) {
          $this->model->update($id, [

            //no funciona el getpost $this->request->getPost('titulo')
                'titulo' => $this->request->getRawInput()['titulo']
             
            ]);
        } else {
           // return $this->respond($this->validator->getErrors(), 400);
           if($this->validator->getError('titulo')){
            return $this->respond($this->validator->getError('titulo'),400);
           }
        
        }
        return $this->respond($id);
       
    }
    public function delete($id=null)
    {
      
       $this->model->delete($id);
       return $this->respond('ok');
    }
}
