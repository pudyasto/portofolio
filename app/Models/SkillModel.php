<?php

namespace App\Models;

use CodeIgniter\Model;

class SkillModel extends Model
{
    protected $table      = 'skill';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'description',
        'percent',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
