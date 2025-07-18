<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class RegistroModel extends Model
    {
        protected $table = 'usuario';
        protected $primaryKey = 'id_usu';
        protected $allowedFields = ['id_usu','nombre_usu', 'pass_usu', 'rol_id', 'id_propietario', 'id_veterinario'];
        public $Timestamps = false;

    }

?>