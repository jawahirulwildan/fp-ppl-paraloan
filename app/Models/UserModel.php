<?php

namespace App\Models;

use CodeIgniter\Email\Email;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    =
    [
        'email', 'password', 'full_name', 'nik', 'phone_number',
        'address', 'occupation', 'salary', 'bank', 'account_number',
        'emergency_phone', 'emergency_relation', 'balance'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'email' => 'required|valid_email|max_length[255]|is_unique[users.email]',
        'password' => 'required',
        'full_name' => 'required|max_length[255]',
        'nik' => 'required|numeric|max_length[20]',
        'phone_number' => 'required|numeric|max_length[20]',
        'address' => 'required|max_length[128]',
        'occupation' => 'required|max_length[128]',
        'salary' => 'required|numeric|max_length[20]',
        'bank' => 'required|max_length[128]',
        'account_number' => 'required|max_length[20]',
        'emergency_phone' => 'required|max_length[20]',
        'emergency_relation' => 'required|max_length[20]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        return $data;
    }

    public function getUser($userId = false)
    {
        if ($userId == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $userId])->first();
    }

    public function getUserLoans($userId)
    {
        return $this->db->table('loans')->where('user_id', $userId)->get()->getResultArray();
    }

    public function updateBalance($newBalance, $userId)
    {
        // Check if user exists
        $user = $this->find($userId);
        if ($user) {
            // Update the user's balance
            return $this->update($userId, ['balance' => $newBalance]);
        }
        return false; // User not found
    }
}
