<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class RegistroModel extends Model
    {
        protected $table = 'usuario';
        protected $primaryKey = 'id_cedula';
        protected $allowedFields = ['nombre', 'apellido', 'id_cedula', 'correo_electronico', 'contrasena', 'rol'];
        public $Timestamps = false;

    }

?>