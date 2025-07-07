<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'id_usu';
    protected $allowedFields = ['id_usu', 'nombre_usu', 'pass_usu', 'rol_id', 'propietario_id', 'veterinario_id'];
    public $timestamps = false;


    public function validarUsuario($usuario, $password){
        return $this->where('nombre_usu', $usuario)
                    ->where('pass_usu', $password)
                    ->first();
    }

}


?>