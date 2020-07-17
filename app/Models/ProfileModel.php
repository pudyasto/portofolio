<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table      = 'profile';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name',
        'birth_date',
        'birth_place',
        'quotes',
        'about_me',
        'address',
        'city',
        'phone',
        'email',
        'linkedin',
        'instagram',
        'facebook',
        'twitter',
    ];

    protected $useTimestamps = false;
}
