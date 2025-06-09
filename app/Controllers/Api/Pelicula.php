<?php

namespace App\Controllers\Api;

use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController
{

  protected $modelName = 'App\Models\PeliculaModel';
  protected $format = 'json';
  //protected $format='xml';

  public function index()
  {
    return $this->respond($this->model->findAll());
  }
  public function paginado()
  {
    return $this->respond($this->model->paginate(10));
  }
  public function paginado_full()
  {


    $peliculas = $this->model
      ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
        $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
        $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
      })
      ->when($this->request->getGet('categoria_id'), static function ($query, $categoriaId) {
        $query->where('peliculas.categoria_id', $categoriaId);
      })
      ->when($this->request->getGet('etiqueta_id'), static function ($query, $etiquetaId) {
        $query->where('etiquetasid', $etiquetaId);
      })



      ->select('peliculas.*,categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
      ->join('categorias', 'categorias.id=peliculas.categoria_id')
      ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id=peliculas.id', 'left')
      ->join('imagenes', 'imagenes.id=pelicula_imagen.imagen_id', 'left')
      ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id=peliculas.id', 'left')
      ->join('etiquetas', 'etiquetas.id=pelicula_etiqueta.etiqueta_id', 'left');

    $peliculas = $peliculas->groupBy('peliculas.id');
    $peliculas = $peliculas->paginate();


    return $this->respond($peliculas);
  }
  public function index_por_categoria($categoriaId)
  {
    $peliculas = $this->model
      ->select('peliculas.*,categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
      ->join('categorias', 'categorias.id=peliculas.categoria_id')
      ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id=peliculas.id', 'left')
      ->join('imagenes', 'imagenes.id=pelicula_imagen.imagen_id', 'left')
      ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id=peliculas.id', 'left')
      ->join('etiquetas', 'etiquetas.id=pelicula_etiqueta.etiqueta_id', 'left')
      ->where('peliculas.categoria_id', $categoriaId)
      ->groupBy('peliculas.id')->paginate();


    return $this->respond($peliculas);
  }
  public function index_por_etiqueta($etiquetaId)
  {
    $peliculas = $this->model
      ->select('peliculas.*,categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
      ->join('categorias', 'categorias.id=peliculas.categoria_id')
      ->join('pelicula_imagen', 'pelicula_imagen.pelicula_id=peliculas.id', 'left')
      ->join('imagenes', 'imagenes.id=pelicula_imagen.imagen_id', 'left')
      ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_id=peliculas.id', 'left')
      ->join('etiquetas', 'etiquetas.id=pelicula_etiqueta.etiqueta_id', 'left')
      ->where('etiquetas.id', $etiquetaId)
      ->groupBy('peliculas.id')->paginate();


    return $this->respond($peliculas);
  }
  public function show($id = null)
  {

    $data = [
      'pelicula' => $this->model->select('peliculas.*,categorias.titulo as categoria')
        ->join('categorias', 'categorias.id=peliculas.categoria_id')->find($id),
      'imagenes' => $this->model->getImagenesById($id),
      'etiquetas' => $this->model->getEtiquetasById($id),
    ];
    return $this->respond($data);
  }
  //   public function etiquetas_post($id)
  // {
  //     $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
  //     $etiquetaId = $this->request->getPost('etiquetas_id');
  //     $peliculaId = $id;
  //     $peliculaEtiqueta = $peliculaEtiquetaModel
  //         ->where('etiqueta_id', $etiquetaId)
  //         ->where('pelicula_id', $peliculaId)->first();
  //     //  echo json_encode($peliculaEtiqueta);
  //     if (!$peliculaEtiqueta) {
  //         $peliculaEtiquetaModel->insert([
  //             'pelicula_id' => $peliculaId,
  //             'etiqueta_id' => $etiquetaId


  //         ]);
  //     }
  //     //vista anterior 
  //     return $this->respond('ok');
  // }




  public function etiquetas_post($id)
  {
    $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

    // Si estás enviando JSON, usa esto:
    //$data = $this->request->getJSON(true);
    //  $etiquetaId = $data['etiqueta_id'] ?? null;
    $etiquetaId = $this->request->getPost('etiqueta_id');
    if (empty($etiquetaId)) {
      return $this->failValidationErrors('El campo etiqueta_id es obligatorio.');
    }

    $peliculaEtiqueta = $peliculaEtiquetaModel
      ->where('etiqueta_id', $etiquetaId)
      ->where('pelicula_id', $id)
      ->first();

    if (!$peliculaEtiqueta) {
      $peliculaEtiquetaModel->insert([
        'pelicula_id' => $id,
        'etiqueta_id' => $etiquetaId
      ]);
    }

    return $this->respond('ok');
  }


  public function etiqueta_delete($id, $etiquetaId)
  {
    $peliculaEtiqueta = new PeliculaEtiquetaModel();

    $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
      ->where('pelicula_id', $id)
      ->delete();
    //echo 'eliminado';
    echo '{"mensaje":"Eliminado"}';
    return $this->respond('ok');
  }

  public function create()
  {

    // protected $modelName='App\Models\PeliculaModel'; es lo mismo que $peliculaModel = new PeliculaModel();
    //ya no es necesario solo se utiliza model 
    if ($this->validate('peliculasrules')) {
      $id =  $this->model->insert([
        'titulo' => $this->request->getpost('titulo'),
        'descripcion' => $this->request->getpost('descripcion'),
        'categoria_id' => $this->request->getPost('categoria_id'),

      ]);
    } else {

      return $this->respond($this->validator->getErrors(), 400);
    }
    return $this->respond($id);
  }
  public function update($id = null)
  {
    //$peliculaModel = new PeliculaModel();
    if ($this->validate('peliculasrules')) {
      $this->model->update($id, [

        //no funciona el getpost $this->request->getPost('titulo')
        'titulo' => $this->request->getRawInput()['titulo'],
        'descripcion' => $this->request->getRawInput()['descripcion'],
        'categoria_id' => $this->request->getRawInput()['categoria_id'],

      ]);
    } else {
      // return $this->respond($this->validator->getErrors(), 400);
      if ($this->validator->getError('titulo')) {
        return $this->respond($this->validator->getError('titulo'), 400);
      }
      if ($this->validator->getError('descripcion')) {
        return $this->respond($this->validator->getError('descripcion'), 400);
      }
    }
    return $this->respond($id);
  }
  public function delete($id = null)
  {


    $this->model->delete($id);
    return $this->respond('ok');
  }


  function upload($peliculaId)
  {

    //cargar helper
    helper('filesystem');
    if ($imagefile = $this->request->getFile('imagen')) {
      if ($imagefile->isValid()) {
        $validated = $this->validate([
          'imagen' => 'uploaded[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]|max_size[imagen,4096]'
        ]);
        if ($validated) {

          $imageNombre = $imagefile->getRandomName();
          // se crea una variable para asignar la extencion de imagenfile
          $ext = $imagefile->guessExtension();
          //cambiar la ruta donde se guarda la imagen 
          //$imagefile->move(WRITEPATH . 'uploads/', $imageNombre);
          $imagefile->move('./public/uploads/peliculas', $imageNombre);


          $imagenModel = new ImagenModel();
          $imagenId = $imagenModel->insert(
            [
              'imagen' => $imageNombre,
              'extension' => $ext,
              'data' => json_encode(get_file_info('./public/uploads/peliculas/' . $imageNombre))
            ]
          );

          $peliculaImagenModel = new PeliculaImagenModel();
          $peliculaImagenModel->insert([
            'imagen_id' => $imagenId,
            'pelicula_id' => $peliculaId,
          ]);

          // Puedes agregar un mensaje de éxito aquí
        } else {
          // Aquí puedes mostrar los errores de validación
          return $this->respond('imagen cargada con exito');
         // return $this->validator->listErrors();
        }
      } else {
        // Error en la validación del archivo
        return $this->validator->listErrors() . 'Archivo no válido o con errores.';
      }
    }

    return $this->respond('la imagen es requeria ', 400);
  }

      public function borrar_imagen($imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();


        $imagen=$imagenModel->find($imagenId);

        //echo json_encode($imagen);

        //BORRAR ARCHIVO DE LA CARPTE DE IMAGEN 
        if($imagen==null){
                  return $this->respond('no existe');

        }

       // $imagenRuta =WRITEPATH.'uploads/peliculas/'.$imagen->imagen;
       //devuelve un arrar imprmir de esta forma = $imagen['imagen']
       //devuelve un objeto imprimir asi $imagen=>imagen
        $imageRuta ='./public/uploads/peliculas/'.$imagen['imagen'];
        unlink($imageRuta);

        $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
        $imagenModel->delete($imagenId);
        return $this->respond('ok');
    }
}
