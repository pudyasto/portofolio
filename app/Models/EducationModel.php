<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationModel extends Model
{
    protected $table      = 'education';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'institute',
        'graduate',
        'date_start',
        'date_finish',
        'description',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
