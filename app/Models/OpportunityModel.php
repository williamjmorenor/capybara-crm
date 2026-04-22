<?php

namespace App\Models;

use CodeIgniter\Model;

class OpportunityModel extends Model
{
    protected $table         = 'opportunities';
    protected $primaryKey    = 'id';
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['contact_id', 'title', 'amount', 'status', 'close_date', 'notes'];

    protected $validationRules = [
        'title'  => 'required|min_length[2]|max_length[200]',
        'status' => 'required|in_list[new,in_progress,negotiation,won,lost]',
        'amount' => 'permit_empty|decimal',
    ];
}
