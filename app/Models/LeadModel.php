<?php

namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table          = 'leads';
    protected $primaryKey     = 'id';
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $allowedFields  = ['name', 'email', 'source', 'status', 'estimated_value', 'assigned_to', 'notes'];

    protected $validationRules = [
        'name'   => 'required|min_length[2]|max_length[100]',
        'email'  => 'permit_empty|valid_email|max_length[150]',
        'source' => 'required|in_list[web,referral,manual,other]',
        'status' => 'required|in_list[new,contacted,qualified,lost]',
    ];
}
