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
        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModel->find()
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
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
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
        $categoriaModel = new CategoriaModel();

        echo view(
            'dashboard/pelicula/edit',
            [
                'pelicula' => $peliculaModel->find($id),
                'categorias' => $categoriaModel->find()
            ]

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
            $this->asignar_imagen($id);
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

        //obtener todos los regiustros 
        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*,categorias.titulo as categoria')->join('categorias', 'categorias.id=peliculas.categoria_id')->find()
        ];
        // echo var_dump($data);
        echo view('dashboard/pelicula/index', $data);
    }

    ///etiquetas 
    public function etiquetas($id)
    {
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
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas' => $etiquetas,
        ]);
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
        $etiquetaId = $this->request->getPost('etiquetas_id');
        $peliculaId = $id;
        $peliculaEtiqueta = $peliculaEtiquetaModel
            ->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $peliculaId)->first();
        //  echo json_encode($peliculaEtiqueta);
        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId


            ]);
        }
        //vista anterior 
        return redirect()->back();
    }

    public function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();

        $peliculaEtiqueta->where('etiqueta_id', $etiquetaId)
            ->where('pelicula_id', $id)
            ->delete();
        //echo 'eliminado';
        echo '{"mensaje":"Eliminado"}';
        // return redirect()->back()->with('mensaje','Etiqueta eliminada');

    }


    ///////////////imagenes 
 public function descargar_imagen($imagenId){
    $imagenModel= new ImagenModel();
    $imagen =$imagenModel->find($imagenId);
    if($imagen==null){
        return 'no existe imagen';

    }
       // $imagenRuta =WRITEPATH.'uploads/peliculas/'.$imagen->imagen;
       //devuelve un arrar imprmir de esta forma = $imagen['imagen']
       //devuelve un objeto imprimir asi $imagen=>imagen
        $imageRuta ='./public/uploads/peliculas/'.$imagen['imagen'];

        //setFileName(); SI REQUIERES AGREGARLE UN NOMBRE ALA imagen
        return $this->response->download($imageRuta,null);
 }

    public function borrar_imagen($imagenId)
    {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();


        $imagen=$imagenModel->find($imagenId);

        //echo json_encode($imagen);

        //BORRAR ARCHIVO DE LA CARPTE DE IMAGEN 
        if($imagen==null){
            return 'no existe imagen';

        }

       // $imagenRuta =WRITEPATH.'uploads/peliculas/'.$imagen->imagen;
       //devuelve un arrar imprmir de esta forma = $imagen['imagen']
       //devuelve un objeto imprimir asi $imagen=>imagen
        $imageRuta ='./public/uploads/peliculas/'.$imagen['imagen'];
        unlink($imageRuta);

        $peliculaImagenModel->where('imagen_id', $imagenId)->delete();
        $imagenModel->delete($imagenId);
        return redirect()->back()->with('mensaje', 'imagen eliminada');
    }


  ///////////otra forma de elimiar imagen pasando 2 parametros alas 2 tablas falta crear la ruta 
  
    // public function borrar_imagen($peliculaId, $imagenId)
    // {
    //     $imagenModel = new ImagenModel();
    //     $peliculaModel = new PeliculaModel();
    //     $peliculaImagenModel = new PeliculaImagenModel();

    //     $imagen = $imagenModel->find($imagenId);

    //     //archivo
    //     if ($imagen == null) {
    //         return 'no existe imagen';
    //     }
    //     //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
    //     $imageRuta =  'uploads/peliculas/' . $imagen->imagen;
    //     // archivo

    //     // eliminar pivote
    //     $peliculaImagenModel->where('imagen_id', $imagenId)->where('pelicula_id', $peliculaId)->delete();

    //     if ($peliculaImagenModel->where('imagen_id', $imagenId)->countAllResults() == 0) {
    //         // eliminar toda la imagen
    //         unlink($imageRuta);
    //         $imagenModel->delete($imagenId);
    //     }

    //     return redirect()->back()->with('mensaje', 'Imagen Eliminada');
    // }

    private function asignar_imagen($peliculaId)
    {
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
                            'data' => 'pendiente'
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
                    return $this->validator->listErrors();
                }
            } else {
                // Error en la validación del archivo
                return $this->validator->listErrors() . 'Archivo no válido o con errores.';
            }
        }
        // if ($imagefile = $this->request->getFile('imagen')) {
        //     if ($imagefile->isValid()) {

        //         $validated = $this->validate([
        //             'uploaded[imagen]',
        //             'mime_in[imagen,image/jpg,image/gif,image/png]',
        //             'max_size[imagen,4096]'
        //         ]);
        //         if ($validated) {
        //             $imageNombre = $imagefile->getRandomName();
        //             $imagefile->move(WRITEPATH . 'uploads/', $imageNombre);
        //         }
        //         return $this->validator->listErrors();
        //     }
        // }

        //  // Verificar si se envió un archivo
        //  if ($this->request->getFile('imagen')->isValid() && !$this->request->getFile('imagen')->getError()) {
        //     $file = $this->request->getFile('imagen');

        //     // Definir la carpeta donde se guardarán las imágenes
        //     $uploadPath = WRITEPATH . 'uploads/';

        //     // Crear la carpeta si no existe
        //     if (!is_dir($uploadPath)) {
        //         mkdir($uploadPath, 0755, true);
        //     }

        //     // Mover el archivo a la carpeta deseada
        //     if ($file->move($uploadPath)) {
        //         // Opcional: guardar información en la base de datos o mostrar mensaje
        //         return redirect()->back()->with('success', 'Imagen subida correctamente.');
        //     } else {
        //         return redirect()->back()->with('error', 'Error al subir la imagen.');
        //     }
        // } else {
        //     // Manejar errores de validación
        //     return redirect()->back()->with('error', 'Por favor, selecciona una imagen válida.');
        // }


    }
    // para probar esta funcion  se manda a llamar asi $this->generar_imagen(); dentro de otra funcion como arriba 
    // private function generar_imagen(){
    //     $imagenModel = new ImagenModel();
    //     $imagenModel->insert(
    //         [
    //          'imagen'=>date('Y-m-d H:m:s'),
    //          'extension'=>'Pendiente',
    //          'data'=>'pendiente'
    //         ]
    //         );
    // }
    // private function asignar_imagen(){
    //     $peliculaImagenModel = new PeliculaImagenModel();
    //     $peliculaImagenModel->insert([
    //         'imagen_id'=>2,
    //         'pelicula_id'=>3
    //     ]);
    // }
}
