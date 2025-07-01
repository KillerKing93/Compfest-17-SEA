<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel dengan emptyTable() agar aman di semua DBMS
        $this->db->table('testimonials')->emptyTable();

        $data = [
            [
                'customer_name' => 'Alif Nurhidayat',
                'review_message' => 'Makanannya enak dan sehat! Pengiriman selalu tepat waktu. Sangat direkomendasikan.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/150?u=alif'
            ],
            [
                'customer_name' => 'Citra Lestari',
                'review_message' => 'Suka sekali dengan variasi menunya. Tidak pernah bosan dan nutrisinya seimbang.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/150?u=citra'
            ],
            [
                'customer_name' => 'Budi Santoso',
                'review_message' => 'Layanan pelanggan sangat responsif. Membantu saya mengatur paket langganan dengan mudah.',
                'rating' => 4,
                'avatar' => 'https://i.pravatar.cc/150?u=budi'
            ]
        ];

        $this->db->table('testimonials')->insertBatch($data);
    }
}
