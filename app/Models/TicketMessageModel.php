<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketMessageModel extends Model
{
    protected $table         = 'ticket_messages';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['ticket_id', 'author_id', 'author_type', 'message', 'type'];

    protected $validationRules = [
        'ticket_id'   => 'required|integer',
        'message'     => 'required|min_length[1]',
        'author_type' => 'required|in_list[user,client]',
        'type'        => 'required|in_list[public,private]',
    ];
}
