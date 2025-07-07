<?php
namespace App\Controllers;

use App\Models\UsuarioModel;

class LoginController extends BaseController {


    public function traerPagina() {
        return view("login/LoginView");
    }

    public function iniciarSesion() {

        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuarioModel();

        $usuarioEncontrado = $usuarioModel->validarUsuario($usuario, $password);

        

        if ($usuarioEncontrado) {

            session()->set('usuario', $usuarioEncontrado['nombre_usu']);
            session()->set('rol', $usuarioEncontrado['rol_id']);
            
            switch ($usuarioEncontrado["rol_id"]) {
                case '5':
                    session()->set('id_propietario', $usuarioEncontrado['propietario_id']);
                    return redirect()->to('/propietario');
                break;
                case '2':
                    return redirect()->to('/veterinario');
                break;
                
                default:
                    return redirect()->to('/propietario');
                break;
            }
        }else{
            return redirect()->back()->with('mensajeError','Error en usuario y/o contraseña');
        };
       


    }


    public function cerrarSesion(){
        session()->destroy();
        return redirect()->to('/login');
    }


}



