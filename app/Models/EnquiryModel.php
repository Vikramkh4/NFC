<?php

namespace App\Models;

use CodeIgniter\Model;

class EnquiryModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'enquiryid';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false; // Corrected spelling: useSoftDelete -> useSoftDeletes
    protected $protectFields        = true;
    protected $allowedFields        = [
        'email', 'brand_id','name', 'topic', 'comment' ,'status' 
    ];
}
