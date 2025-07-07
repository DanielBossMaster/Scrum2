<?php
namespace App\Controllers;

use App\Models\MascotaModel;
use App\Models\PropietarioModel;
use App\Models\VeterinarioModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Veterinario extends BaseController
{



 public function buscar()
{
    $q = $this->request->getGet('q'); // valor del campo de búsqueda

    $db = \Config\Database::connect(); // ← conexión a la base de datos
    $builder = $db->table('propietario');
    $builder->select('propietario.*, mascota.id_mascota, mascota.nom_mascota, mascota.especie, mascota.color, mascota.nom_vacuna, mascota.fecha_vacunacion, mascota.medicamento');
    $builder->join('mascota', 'mascota.num_propietario = propietario.num_doc');

    if (!empty($q)) {
        $builder->groupStart()
            ->like('propietario.nombre_pro', $q)
            ->orLike('propietario.apellido_pro', $q)
            ->orLike('propietario.num_doc', $q)
            ->orLike('mascota.nom_mascota', $q)
            ->orLike('mascota.especie', $q)
            ->orLike('mascota.color', $q)
            ->orLike('mascota.nom_vacuna', $q)
            ->orLike('mascota.fecha_vacunacion', $q)
            ->orLike('mascota.medicamento', $q)
            ->groupEnd();
    }

    $query = $builder->get();
    $data['resultados'] = $query->getResult();

    return view('veterinario/busqueda', $data);
}



 public function index()
{

    if (!session()->has('usuario')) {
        return redirect()->to('/login')->with('mensajeError','Debe iniciar sesion');
    }
    if (session('rol') != 2) {
        return redirect()->to('/login')->with('mensajeError','Permisos insuficientes');
    }

    $propModel = new PropietarioModel();
    $mascModel = new MascotaModel();

    $data['propietario'] = $propModel->findAll();
    $data['mascota'] = $mascModel->findAll();

    return view("veterinario/index", $data);
}



public function editar($num_doc)
{
    $propModel = new \App\Models\PropietarioModel();
    $data['propietario'] = $propModel->find($num_doc);
    return view('veterinario/editar', $data);
}


/* estoy aqui :v */

  public function guardar()
    {
         $model = new PropietarioModel();
         $model->insert($this->request->getPost());
         return redirect()->to('/veterinario');
    }
 public function eliminar($id)
    {
        $model = new PropietarioModel();
        $model->delete($id);
        return redirect()->to('/veterinario');
    }
 public function actualizar($id)
    {
       
        $model = new PropietarioModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/veterinario');
    }










}
?>