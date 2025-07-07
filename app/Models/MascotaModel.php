<?php
namespace App\Models;

use CodeIgniter\Model;

class MascotaModel extends Model
{
protected $table ='mascota';
protected $primaryKey='id_mascota';
protected $allowedFields = ['nom_mascota','especie','raza','fecha_nacimiento','fecha_vacunacion','nom_vacuna','medicamento','color','genero','num_propietario','num_historia_clinica'];
public $timestamps =false;


}





?>