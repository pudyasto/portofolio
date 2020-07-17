<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'category',
        'name',
        'description',
        'image',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
