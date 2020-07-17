<?php

namespace App\Models;

use CodeIgniter\Model;

class WorkModel extends Model
{
    protected $table      = 'work';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company',
        'position',
        'date_start',
        'date_finish',
        'description',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
