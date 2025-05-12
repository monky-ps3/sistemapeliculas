<?php


namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{

    public function new()
    {
         $categoriaModel = new CategoriaModel();
        echo view('dashboard/pelicula/new',[
            'pelicula'=>new PeliculaModel(),
            'categorias'=>$categoriaModel->find()
        ]);
    }
    public function show($id)
    {
        $peliculaModel = new PeliculaModel();
        $imagenModel = new ImagenModel();
        //var_dump($peliculaModel->find($id));
        //datos de prueba 
       // var_dump($peliculaModel->getImagenesById($id));
       //var_dump($imagenModel->getPeliculasById(2));

        echo view('dashboard/pelicula/show', [
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagenesById($id),
            'etiquetas'=>$peliculaModel->getEtiquetasById($id),
        ]);
    }
    public function create()
    {
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculasrules')) {
            $peliculaModel->insert([
                'titulo' => $this->request->getpost('titulo'),
                'descripcion' => $this->request->getpost('descripcion'),
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
        //sistemapeliculas/dashboard/Pelicula
        //dashboard/pelicula/index
        //ROUTES  REDIRECCIONA A dashboard/Pelicula           Handler      | »    | \App\Controllers\Dashboard\Pelicula::index 
        return redirect()->to('dashboard/Pelicula/')->with('mensaje', 'Registro gstionado de manera exitosa');
        //echo 'creado';
        // var_dump($this->request->getPost('titulo'));
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel= new CategoriaModel();

        echo view(
            'dashboard/pelicula/edit',
            ['pelicula' => $peliculaModel->find($id),
            'categorias'=>$categoriaModel->find()]

        );
    }
    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        if ($this->validate('peliculasrules')) {
            $peliculaModel->update($id, [
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
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
        return redirect()->to('dashboard/Pelicula/')->with('mensaje', 'Registro actualizado de manera exitosa');
    }
    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->delete($id);
        session()->setFlashdata('mensaje', 'Registro eliminado exitosamente');
        return redirect()->back();
    }

    public function index()
    {
        $peliculaModel = new PeliculaModel();
      //  $this->generar_imagen();
        $this->asignar_imagen();
        //obtener todos los regiustros 
        $data=[
            'peliculas'=>$peliculaModel->select('peliculas.*,categorias.titulo as categoria')->join('categorias','categorias.id=peliculas.categoria_id')->find()
        ];
      // echo var_dump($data);
        echo view('dashboard/pelicula/index', $data);
    }

    ///etiquetas 
    public function etiquetas($id){
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet('categoria_id')) {
            $etiquetas = $etiquetaModel
                ->where('categoria_id', $this->request->getGet('categoria_id'))
                ->findAll();
        }
               echo json_encode($this->request->getGet('categoria_id'));
        echo view('dashboard/pelicula/etiquetas', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'categoria_id' =>$this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas,
        ]);
    
    }

    public function etiquetas_post($id){
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
        $etiquetaId = $this->request->getPost('etiquetas_id');
        $peliculaId= $id;
        $peliculaEtiqueta= $peliculaEtiquetaModel
        ->where('etiqueta_id',$etiquetaId)
        ->where('pelicula_id',$peliculaId)->first();
           //  echo json_encode($peliculaEtiqueta);
        if(!$peliculaEtiqueta){
            $peliculaEtiquetaModel->insert([
               'pelicula_id'=>$peliculaId,
               'etiqueta_id'=>$etiquetaId


            ]);
        }
        //vista anterior 
        return redirect()->back();
    }

    public function etiqueta_delete($id,$etiquetaId){
        $peliculaEtiqueta = new PeliculaEtiquetaModel();

        $peliculaEtiqueta->where('etiqueta_id',$etiquetaId)
        ->where('pelicula_id',$id)
        ->delete();
        //echo 'eliminado';
         echo '{"mensaje":"Eliminado"}';
       // return redirect()->back()->with('mensaje','Etiqueta eliminada');

    }


///////////////imagenes 
 // para probar esta funcion  se manda a llamar asi $this->generar_imagen(); dentro de otra funcion como arriba 
    private function generar_imagen(){
        $imagenModel = new ImagenModel();
        $imagenModel->insert(
            [
             'imagen'=>date('Y-m-d H:m:s'),
             'extension'=>'Pendiente',
             'data'=>'pendiente'
            ]
            );
    }
    private function asignar_imagen(){
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert([
            'imagen_id'=>2,
            'pelicula_id'=>3
        ]);
    }
}
