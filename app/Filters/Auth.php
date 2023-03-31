<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class auth implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null) {
        // if (!session()->get('loggedin') == true) {
        //     return redirect()->to(base_url().'/login/index');
        //     exit();
        // }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // TODO: Implement after() method.
    }
}

