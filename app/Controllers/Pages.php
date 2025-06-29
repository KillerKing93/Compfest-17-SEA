<?php

namespace App\Controllers;

class Pages extends BaseController
{
    /**
     * Menampilkan halaman utama (Homepage).
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome to SEA Catering!',
            'activePage' => 'home', // Untuk menandai halaman aktif di navigasi
            'session' => session()
        ];
        // Data testimoni sampel dengan gambar avatar
        $data['testimonials'] = [
            [
                'name' => 'Alif Nurhidayat',
                'review' => 'Makanannya enak dan sehat! Pengiriman selalu tepat waktu. Sangat direkomendasikan.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/150?u=alif'
            ],
            [
                'name' => 'Citra Lestari',
                'review' => 'Suka sekali dengan variasi menunya. Tidak pernah bosan dan nutrisinya seimbang.',
                'rating' => 5,
                'avatar' => 'https://i.pravatar.cc/150?u=citra'
            ],
            [
                'name' => 'Budi Santoso',
                'review' => 'Layanan pelanggan sangat responsif. Membantu saya mengatur paket langganan dengan mudah.',
                'rating' => 4,
                'avatar' => 'https://i.pravatar.cc/150?u=budi'
            ]
        ];
        return view('pages/home', $data);
    }

    /**
     * Menampilkan halaman Menu / Meal Plans.
     */
    public function menu()
    {
        $data = [
            'title' => 'Menu & Meal Plans',
            'activePage' => 'menu'
        ];
        // Data paket makanan (meal plans) dengan gambar yang lebih sesuai
        $data['mealPlans'] = [
            [
                'name' => 'Diet Plan',
                'price' => 'Rp30.000',
                'description' => 'Paket hemat untuk Anda yang ingin menjaga kalori dengan menu lezat dan seimbang setiap hari.',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Cocok untuk program penurunan berat badan. Menu dirancang oleh ahli gizi untuk memastikan asupan kalori terkontrol tanpa mengurangi rasa.'
            ],
            [
                'name' => 'Protein Plan',
                'price' => 'Rp40.000',
                'description' => 'Tingkatkan asupan protein Anda untuk mendukung program pembentukan otot dan gaya hidup aktif.',
                'image' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Didesain khusus untuk para pegiat fitness. Mengandung protein tinggi dari sumber berkualitas seperti dada ayam, ikan salmon, dan telur.'
            ],
            [
                'name' => 'Royal Plan',
                'price' => 'Rp60.000',
                'description' => 'Nikmati hidangan premium dengan bahan-bahan organik pilihan untuk pengalaman kuliner terbaik.',
                'image' => 'https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?q=80&w=1280&auto=format&fit=crop',
                'details' => 'Paket eksklusif dengan bahan-bahan premium seperti daging sapi wagyu, sayuran organik, dan bahan impor lainnya. Manjakan diri Anda dengan kemewahan rasa dan nutrisi.'
            ]
        ];
        return view('pages/menu', $data);
    }

    /**
     * Menampilkan halaman Subscription (placeholder).
     */
    public function subscription()
    {
        $data = [
            'title' => 'Subscription',
            'activePage' => 'subscription'
        ];
        return view('pages/subscription', $data);
    }

    /**
     * Menampilkan halaman Contact Us.
     */
    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'activePage' => 'contact',
            'contact' => [
                'manager' => 'Brian',
                'phone' => '08123456789',
                'email' => 'contact@seacatering.com',
                'address' => 'Jl. Digital Raya No. 17, Jakarta, Indonesia'
            ]
        ];
        return view('pages/contact', $data);
    }

    /**
     * Menangani pengiriman data dari formulir testimoni.
     */
    public function addTestimonial()
    {
        $name = $this->request->getPost('customer_name');
        session()->setFlashdata('success_message', 'Terima kasih, '.esc($name).'! Testimoni Anda telah kami terima.');
        return redirect()->to(base_url('/'));
    }
}
