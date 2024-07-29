<?php

namespace App\Models;

use CodeIgniter\Model;

class Brand_product extends Model
{
    protected $table = 'brand_product';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'brand_id',
        'product_id',
  ];
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false; 

    
    
   public function brand_product($data)  {
      $brand_product = new Brand_product();
      $productModel = new ProductModel();
      if( $data != null){
         if($productModel->insert($data)){
          $product_id  =  $productModel->orderBy("id","desc")->first();
          $brand2 = [
             'brand_id'=>$product_id['brand_id'],
             'product_id'=>$product_id['id']
             ];
          if($brand_product->insert($brand2)){
              return true;
          }
         }
      }
       return false;
     
   } 
     
    
    
    
    
}
