<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'market';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false; // Corrected spelling: useSoftDelete -> useSoftDeletes
    protected $protectFields        = true;
    protected $allowedFields        = [
        'icon', 'name', 'details', 'local_area' 
    ];
}
