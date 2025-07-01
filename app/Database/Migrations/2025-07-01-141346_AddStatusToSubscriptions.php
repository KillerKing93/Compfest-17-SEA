<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToSubscriptions extends Migration
{
    public function up()
    {
        $fields = [
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'active', // Nilai: active, paused, cancelled
                'after'      => 'total_price',
            ],
            'paused_until' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'status',
            ],
        ];
        $this->forge->addColumn('subscriptions', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('subscriptions', ['status', 'paused_until']);
    }
}
