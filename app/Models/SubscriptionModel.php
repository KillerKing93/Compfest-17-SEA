<?php

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
    protected $table            = 'subscriptions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'full_name',
        'phone_number',
        'meal_plan_id',
        'meal_types',
        'delivery_days',
        'allergies',
        'total_price',
        'status', 
        'paused_until',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /**
     * Mengambil semua langganan milik seorang pengguna.
     */
    public function getSubscriptionsByUser(int $userId): array
    {
        return $this->select('subscriptions.*, meal_plans.name as plan_name')
                    ->join('meal_plans', 'meal_plans.id = subscriptions.meal_plan_id', 'left')
                    ->where('subscriptions.user_id', $userId)
                    ->orderBy('subscriptions.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Menghitung statistik untuk Admin Dashboard.
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getDashboardStats(string $startDate, string $endDate): array
    {
        // Pastikan tanggal berakhir mencakup keseluruhan hari
        $endDateTime = $endDate . ' 23:59:59';

        // 1. New Subscriptions: Jumlah langganan baru dalam rentang tanggal.
        $newSubscriptions = $this->where('created_at >=', $startDate)
                                 ->where('created_at <=', $endDateTime)
                                 ->countAllResults();

        // 2. Monthly Recurring Revenue (MRR): Total pendapatan dari langganan aktif.
        $mrr = $this->selectSum('total_price', 'mrr')
                    ->where('status', 'active')
                    ->get()
                    ->getRow()
                    ->mrr ?? 0;

        // 3. Subscription Growth: Jumlah total langganan aktif saat ini.
        $subscriptionGrowth = $this->where('status', 'active')->countAllResults();
        
        // 4. Reactivations: Untuk saat ini, kita akan menyederhanakan metrik ini.
        // Implementasi yang lebih akurat memerlukan tabel riwayat status.
        $reactivations = 0; // Placeholder

        return [
            'newSubscriptions' => $newSubscriptions,
            'mrr' => $mrr,
            'subscriptionGrowth' => $subscriptionGrowth,
            'reactivations' => $reactivations,
        ];
    }
}
