<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    // FIX: Tambahkan 'password' ke dalam allowedFields agar bisa diproses oleh callback.
    // Kolom 'password' ini tidak akan disimpan ke DB karena akan dihapus oleh fungsi hashPassword.
    protected $allowedFields    = ['full_name', 'email', 'password_hash', 'password', 'role'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $beforeInsert   = ['hashPassword'];

    /**
     * Secara otomatis mengenkripsi password sebelum dimasukkan ke database.
     */
    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        // Hapus field password agar tidak tersimpan di database
        unset($data['data']['password']);

        return $data;
    }
}
