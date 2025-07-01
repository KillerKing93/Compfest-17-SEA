<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Menampilkan halaman login.
     */
    public function login()
    {
        // Jika sudah login, redirect ke halaman utama
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        
        $data = [
            'title' => 'Login',
            'activePage' => 'login', // Meskipun tidak di nav utama, ini bisa berguna
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    /**
     * Memproses percobaan login.
     */
    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();

        // Cek user dan verifikasi password
        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
        }

        // Set session data
        $this->setUserSession($user);

        return redirect()->to('/')->with('success', 'Selamat datang kembali, ' . $user['full_name'] . '!');
    }

    /**
     * Menampilkan halaman registrasi.
     */
    public function register()
    {
        // Jika sudah login, redirect ke halaman utama
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
        
        $data = [
            'title' => 'Register',
            'activePage' => 'register',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }

    /**
     * Memproses percobaan registrasi.
     */
    public function attemptRegister()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&].{8,}$/]',
            'password_confirm' => 'required|matches[password]'
        ];
        
        $errors = [
            'password' => [
                'regex_match' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan simbol.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan disimpan (password akan di-hash oleh model)
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => 'user' // Default role
        ];

        $this->userModel->save($data);
        
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menghapus sesi dan me-logout pengguna.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Helper untuk mengatur data sesi pengguna.
     */
    private function setUserSession($user)
    {
        $data = [
            'userId'    => $user['id'],
            'fullName'  => $user['full_name'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'isLoggedIn'=> true,
        ];
        session()->set($data);
    }
}
