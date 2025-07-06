<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testdb extends CI_Controller {
    public function index() {
       
        $this->load->database();

     
        $query = $this->db->query('SELECT COUNT(*) AS total FROM propietario');

     
        $row = $query->row();

        
        echo 'Total de propietarios en la BD: ' . $row->total;
    }
}
