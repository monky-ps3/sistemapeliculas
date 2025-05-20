<?php


namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{

    public function new()
    {
         $categoriaModel = new CategoriaModel();
        echo view('dashboard/etiqueta/new',[
            'etiqueta'=>new EtiquetaModel(),
            'categorias'=>$categoriaModel->find()
        ]);
    }
    public function show($id)
    {
        $etiquetaModel = new EtiquetaModel();

        echo view('dashboard/etiqueta/show', [
            'etiqueta' => $etiquetaModel->find($id)
        ]);
    }
    public function create()
    {
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetasrules')) {
            $etiquetaModel->insert([
                'titulo' => $this->request->getpost('titulo'),
               
                'categoria_id' => $this->request->getpost('categoria_id'),


            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // var_dump($this->validator->getError('titulo'));
            //redirecciona al mismo formulario 
            return redirect()->back()->withInput();
        }
        //sistemaetiquetas/dashboard/Etiqueta
        //dashboard/etiqueta/index
        //ROUTES  REDIRECCIONA A dashboard/Etiqueta           Handler      | »    | \App\Controllers\Dashboard\Etiqueta::index 
        return redirect()->to('dashboard/Etiqueta/')->with('mensaje', 'Registro gstionado de manera exitosa');
        //echo 'creado';
        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel= new CategoriaModel();

        echo view(
            'dashboard/etiqueta/edit',
            ['etiqueta' => $etiquetaModel->find($id),
            'categorias'=>$categoriaModel->find()]

        );
    }
    public function update($id)
    {
        $etiquetaModel = new EtiquetaModel();
        if ($this->validate('etiquetasrules')) {
            $etiquetaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
              
                'categoria_id' => $this->request->getpost('categoria_id')
            ]);
        } else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // var_dump($this->validator->getError('titulo'));
            //redirecciona al mismo formulario 
            //withInput recupera el valor del forumulaio actuali una letra o nueva
            return redirect()->back()->withInput();
        }
        //redirecciona si pasa la validacion
        return redirect()->to('dashboard/Etiqueta/')->with('mensaje', 'Registro actualizado de manera exitosa');
    }
    public function delete($id)
    {
        $etiquetaModel = new EtiquetaModel();

        $etiquetaModel->delete($id);
        session()->setFlashdata('mensaje', 'Registro eliminado exitosamente');
        return redirect()->back();
    }

    public function index()
    {
        $etiquetaModel = new EtiquetaModel();
    
        $data=[
            'etiquetas'=>$etiquetaModel->select('etiquetas.*,categorias.titulo as categoria')
            ->join('categorias','categorias.id=etiquetas.categoria_id')
            ->paginate(10),
            'pager'=>$etiquetaModel->pager
            //->find()
        ];
      // echo var_dump($data);
        echo view('dashboard/etiqueta/index', $data);
    }

  
}
