<?php
namespace App\Controllers;
use App\Models\RegistroModel;

class Registro extends BaseController
{
    public function index()
    {
        $model = new RegistroModel();
        $data['usurio'] = $model->findAll();
        return view("registro/index", $data);
    }

    
}

?>