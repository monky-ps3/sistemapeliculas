<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuario extends BaseController
{
    public function index()
    {
        //

    }
    public function crear_usuario(){
        $usuarioModel = new UsuarioModel();

        $usuarioModel->insert(
            [
                'usuario'=>'admin',
                'email'=>'admin@gmail.com',
                'contrasena'=>$usuarioModel->contrasenaHash('12345'),
            ]
            );
    }
    public function probar_contrasena(){
        $usuarioModel = new UsuarioModel();
        
        var_dump($usuarioModel->contrasenaVerificar('12345','$2y$10$5ArprXOy1gkrOgXvzDeJ4.dqAGWHJokOqtGVzvG1QWXdKJvd97Izq'));
    }
  //llamar al forumulario
    public function login(){
        echo view('web/usuario/login');
    }
    public function login_post(){
        $usuarioModel = new UsuarioModel();
        //consulta para buscar usuario si existe
        $email=$this->request->getPost('email');
        $contrasena=$this->request->getPost('contrasena');

        $usuario=$usuarioModel->select('id,usuario,email,contrasena,tipo')
        ->orwhere('email',$email)
        ->orWhere('usuario',$email)
        //obtener primera conincidencia
        ->first();
          //si no encuentra coincidencia regresa a 
          //var_dump($usuario);
        if(!$usuario){
            return redirect()->back()->with('mensaje','Usuario y/O contrasena invalida');
        }

        //verificar si el usuario es correcto 
        if($usuarioModel->contrasenaVerificar($contrasena,$usuario->contrasena)){
          //  $session=session();
            //unset eliminar un campo del array
            unset($usuario->contrasena);

          session()->set('usuario',$usuario);

        return redirect()->to('dashboard/Categoria/')->with('mensaje',"Bienvenido@ $usuario->usuario");
   
        }
        //usuario o conraseña incorrecto 
      return redirect()->back()->with('mensaje',"Usuario o contrasena invalido");

    }
    public function register(){
        echo view('web/usuario/registrar');

    }
    public function register_post(){
        $usuarioModel = new UsuarioModel();
        if($this->validate('usuarios')){
            $usuarioModel->insert(
                [
                    'usuario'=>$this->request->getPost('usuario'),
                    'email'=>$this->request->getPost('email'),
                    'contrasena'=>$usuarioModel->contrasenaHash($this->request->getPost('contrasena'))
                ]);
                return redirect()->to('login')->with('mensaje',"Usuario registrado con exito");

        }
          // linia de codigo para que muestre los errores 
        session()->setFlashdata([
            'validation'=>$this->validator
        ]);
        return redirect()->back()->withInput();


    }
    //cerrar session
    public function logout(){
       session()->destroy();
       return redirect()->to(route_to('login'));
    }


}
