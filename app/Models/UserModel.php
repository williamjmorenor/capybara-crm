<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'email', 'password', 'role', 'active'];

    protected $validationRules = [
        'name'  => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|max_length[150]',
        'role'  => 'required|in_list[admin,user]',
    ];

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->where('deleted_at', null)->first();
    }
}
