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

    public function index()
    {
        $data = [
            'title' => 'Formulir Langganan',
            'activePage' => 'subscription',
            'mealPlans' => $this->mealPlanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // Mengisi nama & no. telp dari data user yang login
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('userId'));
        $data['user_full_name'] = $user['full_name'];
        // Anda bisa menambahkan kolom no. telp di tabel user jika perlu

        return view('pages/subscription_form', $data);
    }

    public function process()
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[255]',
            'phone_number' => 'required|numeric|min_length[10]|max_length[15]',
            'meal_plan_id' => 'required|is_not_unique[meal_plans.id]',
            'meal_types' => 'required',
            'delivery_days' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/subscription')->withInput();
        }

        $mealPlan = $this->mealPlanModel->find($this->request->getPost('meal_plan_id'));
        $mealTypesCount = count($this->request->getPost('meal_types'));
        $deliveryDaysCount = count($this->request->getPost('delivery_days'));

        $totalPrice = $mealPlan['price'] * $mealTypesCount * $deliveryDaysCount * 4.3;

        // Simpan data ke database
        $this->subscriptionModel->save([
            'user_id' => session()->get('userId'), // Tambahkan user ID yang sedang login
            'full_name' => $this->request->getPost('full_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'meal_plan_id' => $this->request->getPost('meal_plan_id'),
            'meal_types' => implode(',', $this->request->getPost('meal_types')),
            'delivery_days' => implode(',', $this->request->getPost('delivery_days')),
            'allergies' => $this->request->getPost('allergies'),
            'total_price' => $totalPrice,
        ]);

        session()->setFlashdata('success_message', 'Selamat, '.esc($this->request->getPost('full_name')).'! Langganan Anda berhasil dibuat.');
        return redirect()->to('/subscription/success');
    }

    public function success()
    {
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
