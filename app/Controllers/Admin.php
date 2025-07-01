<?php

namespace App\Controllers;

use App\Models\SubscriptionModel;

class Admin extends BaseController
{
    protected $subscriptionModel;

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
    }

    /**
     * Menampilkan halaman utama Admin Dashboard.
     */
    public function index()
    {
        // Ambil rentang tanggal dari URL, atau default ke bulan ini.
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-t');

        $data = [
            'title' => 'Admin Dashboard',
            'activePage' => 'admin_dashboard',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'stats' => $this->subscriptionModel->getDashboardStats($startDate, $endDate)
        ];

        return view('admin/index', $data);
    }
}
