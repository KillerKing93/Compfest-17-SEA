<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'user', // 'user' atau 'admin'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // Tambahkan kolom user_id ke subscriptions
        $this->forge->addColumn('subscriptions', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'after'      => 'id'
            ]
        ]);

        // Hanya tambahkan foreign key jika BUKAN SQLite
        if ($this->db->DBDriver !== 'SQLite3') {
            $this->db->query('ALTER TABLE `subscriptions` ADD CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        }
    }

    public function down()
    {
        // Hapus foreign key hanya jika BUKAN SQLite
        if ($this->db->DBDriver !== 'SQLite3') {
            $this->forge->dropForeignKey('subscriptions', 'subscriptions_user_id_foreign');
        }
        $this->forge->dropColumn('subscriptions', 'user_id');
        $this->forge->dropTable('users');
    }
}
