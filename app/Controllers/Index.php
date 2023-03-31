<?php namespace App\Controllers;
    use CodeIgniter\Controller;

    class Index extends BaseController {
        public function __construct() {
            $this->session = \Config\Services::session();
        }

        public function index() {
            $data['title'] = 'Todos (Aktuelles Projekt)';

            echo view('templates/header', $data);
            echo view('pages/Index', $data);
            echo view('templates/footer');
        }
    }
