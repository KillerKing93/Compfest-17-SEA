<?php

namespace App\Controllers;

use App\Models\SubscriptionModel;

class Dashboard extends BaseController
{
    protected $subscriptionModel;

    public function __construct()
    {
        $this->subscriptionModel = new SubscriptionModel();
    }

    /**
     * Menampilkan dashboard pengguna dengan daftar langganan mereka.
     */
    public function index()
    {
        $userId = session()->get('userId');
        
        $data = [
            'title' => 'User Dashboard',
            'activePage' => 'dashboard',
            'subscriptions' => $this->subscriptionModel->getSubscriptionsByUser($userId)
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Mengubah status langganan menjadi 'cancelled'.
     */
    public function cancel($subscriptionId)
    {
        $userId = session()->get('userId');
        // Verifikasi bahwa langganan ini milik pengguna yang sedang login
        $subscription = $this->subscriptionModel->where('id', $subscriptionId)->where('user_id', $userId)->first();

        if ($subscription) {
            $this->subscriptionModel->update($subscriptionId, ['status' => 'cancelled']);
            return redirect()->to('/dashboard')->with('success', 'Langganan telah berhasil dibatalkan.');
        }

        return redirect()->to('/dashboard')->with('error', 'Gagal membatalkan langganan.');
    }

    /**
     * Mengubah status langganan menjadi 'paused' hingga tanggal tertentu.
     */
    public function pause($subscriptionId)
    {
        $userId = session()->get('userId');
        $pauseUntil = $this->request->getPost('pause_until');

        // Validasi tanggal
        if (empty($pauseUntil) || strtotime($pauseUntil) < time()) {
             return redirect()->to('/dashboard')->with('error', 'Tanggal jeda tidak valid.');
        }

        // Verifikasi bahwa langganan ini milik pengguna yang sedang login
        $subscription = $this->subscriptionModel->where('id', $subscriptionId)->where('user_id', $userId)->first();

        if ($subscription) {
            $this->subscriptionModel->update($subscriptionId, [
                'status' => 'paused',
                'paused_until' => $pauseUntil
            ]);
            return redirect()->to('/dashboard')->with('success', 'Langganan telah dijeda hingga tanggal ' . $pauseUntil);
        }

        return redirect()->to('/dashboard')->with('error', 'Gagal menjeda langganan.');
    }

    /**
     * Mengaktifkan kembali langganan yang sedang dijeda.
     */
    public function resume($subscriptionId)
    {
        $userId = session()->get('userId');
        $subscription = $this->subscriptionModel->where('id', $subscriptionId)->where('user_id', $userId)->first();

        if ($subscription && $subscription['status'] === 'paused') {
            $this->subscriptionModel->update($subscriptionId, [
                'status' => 'active',
                'paused_until' => null
            ]);
            return redirect()->to('/dashboard')->with('success', 'Langganan telah aktif kembali.');
        }

        return redirect()->to('/dashboard')->with('error', 'Gagal mengaktifkan langganan.');
    }
}
