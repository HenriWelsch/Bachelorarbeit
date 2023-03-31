<?php namespace App\Controllers;
use App\Models\PersonenModel;
use CodeIgniter\Controller;

class Login extends BaseController {
    public function __construct() {
        $this->PersonenModel = new PersonenModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function index() {
        helper("form");

        $data['title'] = 'Login';
        echo CI_VERSION;


        if (isset($_POST['username']) && isset($_POST['passwort'])) {
            if ($this->validation->run($_POST, 'val_login')) {
                If ($this->PersonenModel->login() != NULL) {
                    $passwort = $this->PersonenModel->login()['passwort'];

                    if (password_verify($_POST['passwort'], $passwort)) {
                        $this->session->set('loggedin', TRUE);
                        $this->session->set($this->PersonenModel->getUser());

                        return redirect()->to(base_url().'/Projekte');
                    }
                }
            } else {
                $data['error'] = $this->validation->getErrors();
            }
        }

        echo view('templates/header', $data);
        echo view('pages/Login');
        echo view('templates/Footer');
    }
}