<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'u_id',
        'market',
        'logo',
        'name',
        'email',
        'phone_no',
        'address',
        'website',
        'google_review' ,
        'whatsapp_no',
        'enqlink',
        'twitter',
        'instagram',	
        'facebook',
        'others'	
    ];
    
    protected $returnType = 'array';

    protected $validationRules = [
     
    ];
    

    protected $validationMessages = [
       
      
    ];

    protected $skipValidation = false; 
}
