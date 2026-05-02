<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table          = 'tickets';
    protected $primaryKey     = 'id';
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'title', 'description', 'client_id', 'assigned_to',
        'status', 'priority', 'type', 'is_billable', 'closed_at',
    ];

    protected $validationRules = [
        'title'  => 'required|min_length[2]|max_length[200]',
        'status' => 'required|in_list[new,assigned,solved,closed]',
        'type'   => 'required|in_list[support,warranty,incident,commercial]',
    ];
}
