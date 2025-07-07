<?php
namespace App\Controllers;

use App\Models\PropietarioModel;
use App\Models\MascotaModel;

class Propietario extends BaseController
{
    public function index()
    {
        if (!session()->has('usuario') || session('rol') != 5) {
            return redirect()->to('/login')->with('mensajeError', 'Debe iniciar sesión como propietario');
        }

        $idPropietario = session('id_propietario'); 
        $propModel = new PropietarioModel();
        $mascModel = new MascotaModel();

        $data['propietario'] = $propModel->find($idPropietario);
        $data['mascotas'] = $mascModel->where('num_propietario', $idPropietario)->findAll();

        return view('propietario/index', $data);
    }

    public function editar($num_doc)
    {
        $propModel = new PropietarioModel();
        $data['propietario'] = $propModel->find($num_doc);
        return view('propietario/editar', $data);
    }

    public function actualizar($num_doc)
    {
        $propModel = new PropietarioModel();
        $propModel->update($num_doc, $this->request->getPost());
        return redirect()->to('/propietario');
    }

    public function imprimir_historia($num_doc)
    {
        $propModel = new PropietarioModel();
        $mascModel = new MascotaModel();

        $data['propietario'] = $propModel->find($num_doc);
        $data['mascotas'] = $mascModel->where('num_propietario', $num_doc)->findAll();

        return view('propietario/imprimir_historia', $data);
    
    }
    public function crearMascota()
    {
        return view('propietario/crear_mascota');
    }
    public function guardarMascota()
    {
        $mascotaModel = new MascotaModel();

        $mascotaData = [
            'nom_mascota' => $this->request->getPost('nom_mascota'),
            'especie' => $this->request->getPost('especie'),
            'raza' => $this->request->getPost('raza'),
            'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
            'fecha_vacunacion' => $this->request->getPost('fecha_vacunacion'),
            'nom_vacuna' => $this->request->getPost('nom_vacuna'),
            'medicamento' => $this->request->getPost('medicamento'),
            'color' => $this->request->getPost('color'),
            'genero' => $this->request->getPost('genero'),
            'num_propietario' => session('id_propietario')
        ];

        $mascotaModel->insert($mascotaData);
        return redirect()->to('/propietario')->with('mensaje', 'Mascota registrada exitosamente');
    }

    public function eliminarMascota($id)
    {
        $mascotaModel = new MascotaModel();
        $mascotaModel->delete($id);
        return redirect()->to('/propietario')->with('mensaje', 'Mascota eliminada');
    }
}
