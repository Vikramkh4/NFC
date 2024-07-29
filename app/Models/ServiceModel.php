<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = [
      'id','brand_id','image','name','details'
 
    ];
    
    protected $returnType = 'array';

    protected $validationRules = [
        'name' => 'required',
        'details' => 'required',
         
         
    ];
    

    protected $validationMessages = [
         
         'name' => [
             'required' => 'The name field is required.'
         ],
         'details' => [
             'required' => 'Please provide detail.'
         ],
         

      
    ];

    protected $skipValidation = false; 
}
