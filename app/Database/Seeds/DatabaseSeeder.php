<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan semua seeder yang ingin dijalankan di sini
        // Contoh:
        // $this->call('UserSeeder');
        // $this->call('ProductSeeder');

        // Otomatis jalankan semua seeder di folder ini (kecuali DatabaseSeeder sendiri)
        $seeders = [
            // Tambahkan nama seeder lain di sini, contoh:
            // 'UserSeeder',
            // 'ProductSeeder',
            'MealPlanSeeder',
            'TestimonialSeeder',
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
