<?php

namespace App\Models;

use CodeIgniter\Model;

class TagModel extends Model
{
    protected $table         = 'tags';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'color'];

    protected $validationRules = [
        'name'  => 'required|min_length[1]|max_length[100]',
        'color' => 'permit_empty|max_length[20]',
    ];
}
