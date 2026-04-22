<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table          = 'contacts';
    protected $primaryKey     = 'id';
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $allowedFields  = ['name', 'email', 'phone', 'company', 'status', 'notes'];

    protected $validationRules = [
        'name'   => 'required|min_length[2]|max_length[100]',
        'email'  => 'permit_empty|valid_email|max_length[150]',
        'status' => 'required|in_list[active,inactive]',
    ];
}
