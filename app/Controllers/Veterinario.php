<?php
namespace App\Controllers;

use App\Models\MascotaModel;
use App\Models\PropietarioModel;
use App\Models\VeterinarioModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Veterinario extends BaseController
{



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
    $mascModel = new \App\Models\MascotaModel();

    // Buscar propietario
    $data['propietario'] = $propModel->find($num_doc);

    // Buscar mascota (si hay una asociada)
    $data['mascota'] = $mascModel
        ->where('num_propietario', $num_doc)
        ->first(); // Si tienes varias, luego vemos cómo mostrarlas

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