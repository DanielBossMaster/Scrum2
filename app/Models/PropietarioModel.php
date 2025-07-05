<?php
namespace App\Models;

use CodeIgniter\Model;

class PropietarioModel extends Model
{
protected $table = 'propietario';
protected $primaryKey= 'num_doc';
protected $allowedFields = ['num_doc','nombre_pro','apellido_pro','direccion_pro','telefono_pro','correo_pro'];
public $timestamps =false;

}





?>