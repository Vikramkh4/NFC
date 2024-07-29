<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = [
      'id','brand_id','image','product','details','price'	
 
    ];
    
    protected $returnType = 'array';

    protected $validationRules = [
        'product' => 'required',
        'details' => 'required',
         'price' => 'required',
         
    ];
    

    protected $validationMessages = [
         'image' => [
             'uploaded' => 'Please upload a logo.',
             
            
         ],
         'product' => [
             'required' => 'The product field is required.'
         ],
         'details' => [
             'required' => 'Please provide detail.'
         ],
         'price' => [
          'required' => 'Please provide price.'
      ],

      
    ];

    protected $skipValidation = false; 
}
