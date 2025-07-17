<?php

namespace App\Controllers;

use App\Models\RegistroModel;
use App\Models\UsuarioModel;
use App\Models\PropietarioModel;
use App\Models\VeterinarioModel;


class Registro extends BaseController
    {
        public function index()
        {
            return view("registro/index");
        }

        public function registrar()
        {
            
            $rol = $this->request->getPost('rol'); // propietario o veterinario

            // Definir rol_id numérico
            $rol_id = match($rol) {
                'propietario' => 5,
                'veterinario' => 2,
                default => null
            };

            if ($rol_id === null) {
            return redirect()->back()->with('error', 'Rol inválido');
            }

            $usuarioModel = new RegistroModel();

            $usuarioData = [
            'nombre_usu' => $this->request->getPost('usuario'),
            'pass_usu'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol_id'     => $rol_id
            ];

            $usuario_id = $usuarioModel->insert($usuarioData, true);

            if ($rol === 'propietario') {
                $propietarioModel = new PropietarioModel();
                $propietario_id = $propietarioModel->insert([
                    'id_usuario'       => $usuario_id,
                    'num_doc'              => $this->request->getPost('num_doc'),
                    'nombre_pro'           => $this->request->getPost('nombre'),
                    'apellido_pro'         => $this->request->getPost('apellido'),
                    'direccion_pro'        => $this->request->getPost('direccion'),
                    'telefono_pro'         => $this->request->getPost('telefono'),
                    'correo_pro'           => $this->request->getPost('correo')
                ], true);
                $usuarioModel->update($usuario_id, ['propietario_id' => $propietario_id]);

            } elseif ($rol === 'veterinario') {
                $veterinarioModel = new VeterinarioModel();
                $veterinario_id = $veterinarioModel->insert([
                    'id_usuario'  => $usuario_id,
                    'num_licencia'    => $this->request->getPost('licencia'),
                    'nombre_vete'           => $this->request->getPost('nombre_vete'),
                    'apellido_vete'         => $this->request->getPost('apellido_vete'),
                    'direccion_vete'        => $this->request->getPost('direccion_vete'),
                    'telefono_vete'         => $this->request->getPost('telefono_vete'),
                    'correo_vete'           => $this->request->getPost('correo_vete')
                ], true);
                $usuarioModel->update($usuario_id, ['veterinario_id' => $veterinario_id]);
            }   
            return redirect()->to(base_url('/login'))->with('mensaje', '¡Usuario registrado!');
        } 

        public function cerrarSesion(){
            session()->destroy();
            return redirect()->to('/login');
        }
    }

    ?>