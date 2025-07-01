<?php

namespace App\Controllers;

use App\Models\MealPlanModel;
use App\Models\SubscriptionModel;

class Subscription extends BaseController
{
    protected $mealPlanModel;
    protected $subscriptionModel;

    public function __construct()
    {
        $this->mealPlanModel = new MealPlanModel();
        $this->subscriptionModel = new SubscriptionModel();
    }

    /**
     * Menampilkan formulir langganan.
     */
    public function index()
    {
        $data = [
            'title' => 'Formulir Langganan',
            'activePage' => 'subscription',
            'mealPlans' => $this->mealPlanModel->findAll(),
            'validation' => \Config\Services::validation() // Mengirimkan service validasi ke view
        ];
        return view('pages/subscription_form', $data);
    }

    /**
     * Memproses data dari formulir langganan.
     */
    public function process()
    {
        // 1. Aturan Validasi
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[255]',
            'phone_number' => 'required|numeric|min_length[10]|max_length[15]',
            'meal_plan_id' => 'required|is_not_unique[meal_plans.id]',
            'meal_types' => 'required',
            'delivery_days' => 'required',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke formulir dengan error
            return redirect()->to('/subscription')->withInput();
        }

        // 2. Kalkulasi Ulang Harga di Server (untuk keamanan)
        $mealPlan = $this->mealPlanModel->find($this->request->getPost('meal_plan_id'));
        $mealTypesCount = count($this->request->getPost('meal_types'));
        $deliveryDaysCount = count($this->request->getPost('delivery_days'));

        // Formula: Harga Plan * Jml Tipe Makanan * Jml Hari Pengiriman * 4.3 (minggu dalam sebulan)
        $totalPrice = $mealPlan['price'] * $mealTypesCount * $deliveryDaysCount * 4.3;

        // 3. Simpan data ke database
        $this->subscriptionModel->save([
            'full_name' => $this->request->getPost('full_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'meal_plan_id' => $this->request->getPost('meal_plan_id'),
            'meal_types' => implode(',', $this->request->getPost('meal_types')), // Simpan sebagai string
            'delivery_days' => implode(',', $this->request->getPost('delivery_days')), // Simpan sebagai string
            'allergies' => $this->request->getPost('allergies'),
            'total_price' => $totalPrice,
        ]);

        // 4. Set flashdata dan redirect ke halaman sukses
        session()->setFlashdata('success_message', 'Selamat, '.esc($this->request->getPost('full_name')).'! Langganan Anda berhasil dibuat.');
        return redirect()->to('/subscription/success');
    }

    /**
     * Menampilkan halaman konfirmasi sukses.
     */
    public function success()
    {
        // Cek jika tidak ada pesan sukses, redirect ke homepage
        if (!session()->getFlashdata('success_message')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Langganan Berhasil',
            'activePage' => 'subscription',
        ];
        return view('pages/subscription_success', $data);
    }
}
