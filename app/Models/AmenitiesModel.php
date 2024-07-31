<?php

namespace App\Models;

use CodeIgniter\Model;

class AmenitiesModel extends Model
{
    protected $table = 'amenities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'icon',
        'name',
        'slug',
  ];
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false; 

    
    
 
     
    
    
    
    
}
