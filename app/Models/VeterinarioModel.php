<?php
namespace App\Models;

use CodeIgniter\Model;

class VeterinarioModel extends Model
{

protected $table = 'veterinario';
protected $primaryKey ='num_licencia';
protected $allowedFields =['num_licencia','nombre_vete','apellido_vete','direccion_vete','	telefono_vete','correo_vete'];
public $Timestamps = false;
}






















?>