<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get("log") != true) {
            session()->setFlashdata("error", "Siahkan login terlebih dahulu");
            return redirect()->to(site_url("auth/login"));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
