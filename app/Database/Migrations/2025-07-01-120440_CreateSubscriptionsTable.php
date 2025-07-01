<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'meal_plan_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'meal_types' => [
                'type'       => 'VARCHAR', // e.g., "Breakfast,Lunch"
                'constraint' => '255',
            ],
            'delivery_days' => [
                'type'       => 'VARCHAR', // e.g., "Monday,Tuesday"
                'constraint' => '255',
            ],
            'allergies' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('meal_plan_id', 'meal_plans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('subscriptions');
    }
}
