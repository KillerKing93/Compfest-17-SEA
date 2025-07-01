<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MealPlanSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel dengan emptyTable() agar aman di semua DBMS
        $this->db->table('meal_plans')->emptyTable();

        $data = [
            [
                'name' => 'Diet Plan',
                'price' => 30000.00,
                'description' => 'Paket hemat untuk Anda yang ingin menjaga kalori dengan menu lezat dan seimbang setiap hari.',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Cocok untuk program penurunan berat badan. Menu dirancang oleh ahli gizi untuk memastikan asupan kalori terkontrol tanpa mengurangi rasa.',
            ],
            [
                'name' => 'Protein Plan',
                'price' => 40000.00,
                'description' => 'Tingkatkan asupan protein Anda untuk mendukung program pembentukan otot dan gaya hidup aktif.',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Didesain khusus untuk para pegiat fitness. Mengandung protein tinggi dari sumber berkualitas seperti dada ayam, ikan salmon, dan telur.',
            ],
            [
                'name' => 'Royal Plan',
                'price' => 60000.00,
                'description' => 'Nikmati hidangan premium dengan bahan-bahan organik pilihan untuk pengalaman kuliner terbaik.',
                'image' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Paket eksklusif dengan bahan-bahan premium seperti daging sapi wagyu, sayuran organik, dan bahan impor lainnya. Manjakan diri Anda dengan kemewahan rasa dan nutrisi.',
            ],
        ];

        $this->db->table('meal_plans')->insertBatch($data);
    }
}
