<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah pengguna sudah login DAN memiliki peran 'admin'
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            // Jika tidak, redirect ke halaman utama dengan pesan error
            return redirect()->to(base_url('/'))->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi yang perlu dilakukan setelahnya
    }
}
