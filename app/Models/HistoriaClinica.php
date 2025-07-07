<?php
namespace App\Models;

use CodeIgniter\Model;

class MascotaModel extends Model
{
protected $table ='historia_clinica';
protected $primaryKey='id_historia_clinica';
protected $allowedFields = ['fecha_actualizacion','fecha_apertura','tratamiento','diagnostico','num_id_mascota'];
public $timestamps =false;


}





?>