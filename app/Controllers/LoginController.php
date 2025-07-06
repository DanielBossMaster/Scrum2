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
            switch ($usuarioEncontrado["rol_id"]) {
                case '5':
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
            return redirect()->to('/login');
        };
       


    }


}



