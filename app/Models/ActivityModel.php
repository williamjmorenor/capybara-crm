<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table         = 'activities';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['type', 'description', 'date', 'related_type', 'related_id', 'created_by'];

    protected $validationRules = [
        'type'        => 'required|in_list[call,email,meeting,note]',
        'description' => 'required|min_length[2]',
        'date'        => 'required|valid_date[Y-m-d H:i:s]',
    ];
}
