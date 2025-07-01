<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        // Data untuk admin
        $adminData = [
            'full_name' => 'Admin SEA',
            'email'     => 'admin@seacatering.com',
            'password'  => 'Password123!', // Password yang kuat
            'role'      => 'admin',
        ];

        // Cek jika admin sudah ada, jangan buat lagi
        if ($userModel->where('email', $adminData['email'])->first() === null) {
            $userModel->save($adminData);
            echo "Admin user created successfully.\n";
            echo "Email: " . $adminData['email'] . "\n";
            echo "Password: " . $adminData['password'] . "\n";
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
