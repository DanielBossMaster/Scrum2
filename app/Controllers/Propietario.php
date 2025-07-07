<?php
namespace App\Controllers;

use App\Models\PropietarioModel;
use App\Models\MascotaModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    $data = [
        'nombre_pro' => $this->request->getPost('nombre_pro'),
        'direccion_pro' => $this->request->getPost('direccion_pro'),
        'telefono_pro' => $this->request->getPost('telefono_pro'),
        'correo_pro' => $this->request->getPost('correo_pro'),
    ];

    $propModel->update($num_doc, $data);

    return redirect()->to('/propietario')->with('mensaje', 'Datos del propietario actualizados correctamente');
}


    public function imprimir_historia($num_doc)
    {
        $propModel = new PropietarioModel();
        $mascModel = new MascotaModel();

        $data['propietario'] = $propModel->find($num_doc);
        $data['mascotas'] = $mascModel->where('num_propietario', $num_doc)->findAll();

        return view('propietario/imprimir_historia', $data);
    
    }


    public function exportarExcelMascotas($num_doc)
    {
        $model = new MascotaModel();
        $mascotas = $model->where('num_propietario', $num_doc)->findAll();
        //crear hoja de excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        //crear encabezados excel
        $sheet->setCellValue('A1','nom_mascota');
        $sheet->setCellValue('B1','especie');
        $sheet->setCellValue('C1','raza');
        $sheet->setCellValue('D1','fecha_nacimiento');
        $sheet->setCellValue('E1','fecha_vacunacion');
        $sheet->setCellValue('F1','nom_vacuna');
        $sheet->setCellValue('G1','medicamento');
        $sheet->setCellValue('H1','color');
        $sheet->setCellValue('I1','genero');
        //llenar las celdas
        $fila = 2;
        foreach($mascotas as $mascota)
        {
            $sheet->setCellValue('A'.$fila, $mascota['nom_mascota']);
            $sheet->setCellValue('B'.$fila, $mascota['especie']);
            $sheet->setCellValue('C'.$fila, $mascota['raza']);
            $sheet->setCellValue('D'.$fila, $mascota['fecha_nacimiento']);
            $sheet->setCellValue('E'.$fila, $mascota['fecha_vacunacion']);
            $sheet->setCellValue('F'.$fila, $mascota['nom_vacuna']);
            $sheet->setCellValue('G'.$fila, $mascota['medicamento']);
            $sheet->setCellValue('H'.$fila, $mascota['color']);
            $sheet->setCellValue('I'.$fila, $mascota['genero']);
            $fila++;
        }

        //Descargar excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'mascotas_'.date('Ymd_His').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        ob_end_clean();

        $writer->save('php://output');
        exit;

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
