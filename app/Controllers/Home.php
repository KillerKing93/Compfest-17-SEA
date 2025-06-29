<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Menampilkan halaman utama (homepage) SEA Catering.
     *
     * @return string
     */
    public function index(): string
    {
        // Data yang akan dikirimkan ke view.
        // Anda bisa memindahkan data ini ke model atau file konfigurasi nantinya.
        $data = [
            'title' => 'Welcome to SEA Catering!',
            'businessName' => 'SEA Catering',
            'slogan' => 'Healthy Meals, Anytime, Anywhere',
            'welcomeMessage' => 'Selamat datang di SEA Catering! Kami menyediakan layanan makanan sehat yang dapat disesuaikan dan dikirim ke seluruh Indonesia. Nikmati kemudahan memesan makanan sehat berkualitas langsung ke depan pintu Anda.',
            'features' => [
                'Kustomisasi Menu Makanan',
                'Pengiriman ke Kota-kota Besar',
                'Informasi Nutrisi Lengkap',
                'Paket Langganan Fleksibel'
            ],
            'contact' => [
                'manager' => 'Brian',
                'phone' => '08123456789'
            ]
        ];

        // Memuat view dan mengirimkan data ke dalamnya.
        return view('home_view', $data);
    }
}
