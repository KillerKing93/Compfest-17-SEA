<?php

namespace App\Controllers;

// Import model yang akan digunakan
use App\Models\MealPlanModel;
use App\Models\TestimonialModel;

class Pages extends BaseController
{
    protected $mealPlanModel;
    protected $testimonialModel;

    public function __construct()
    {
        // Inisialisasi model di constructor agar bisa digunakan di semua method
        $this->mealPlanModel = new MealPlanModel();
        $this->testimonialModel = new TestimonialModel();
    }

    /**
     * Menampilkan halaman utama (Homepage).
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome to SEA Catering!',
            'activePage' => 'home',
            'session' => session(),
            // Ambil semua data testimoni dari database
            'testimonials' => $this->testimonialModel->findAll()
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
            'activePage' => 'menu',
            // Ambil semua data meal plan dari database
            'mealPlans' => $this->mealPlanModel->findAll()
        ];
        return view('pages/menu', $data);
    }

    /**
     * Menampilkan halaman Subscription (placeholder).
     * Akan kita kembangkan di langkah selanjutnya.
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
     * Menangani pengiriman data dari formulir testimoni dan menyimpannya ke database.
     */
    public function addTestimonial()
    {
        // Validasi input sederhana
        if (!$this->validate([
            'customer_name' => 'required|min_length[3]|max_length[100]',
            'review_message' => 'required|min_length[10]',
            'rating' => 'required|numeric|greater_than[0]|less_than[6]'
        ])) {
            // Jika validasi gagal, kembalikan ke halaman utama dengan pesan error
            session()->setFlashdata('error_message', 'Gagal menambahkan testimoni. Mohon periksa kembali input Anda.');
            return redirect()->to(base_url('/#testimonials'));
        }

        // Simpan data ke database melalui model
        $this->testimonialModel->save([
            'customer_name' => $this->request->getPost('customer_name'),
            'review_message' => $this->request->getPost('review_message'),
            'rating' => $this->request->getPost('rating'),
            // Membuat URL avatar acak untuk contoh
            'avatar' => 'https://i.pravatar.cc/150?u=' . url_title($this->request->getPost('customer_name'), '-', true)
        ]);
        
        // Mengatur flashdata untuk menampilkan pesan sukses
        session()->setFlashdata('success_message', 'Terima kasih, '.esc($this->request->getPost('customer_name')).'! Testimoni Anda telah kami simpan.');

        // Mengarahkan pengguna kembali ke halaman utama
        return redirect()->to(base_url('/#testimonials'));
    }
}
