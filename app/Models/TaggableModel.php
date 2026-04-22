<?php

namespace App\Models;

use CodeIgniter\Model;

class TaggableModel extends Model
{
    protected $table         = 'taggables';
    protected $primaryKey    = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['tag_id', 'taggable_type', 'taggable_id', 'created_at'];
}
