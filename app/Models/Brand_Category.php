<?php

namespace App\Models;

use CodeIgniter\Model;

class Brand_Category extends Model
{
    protected $table = 'brand_category';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand_id',
        'brand_category',
  ];
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false; 

    
    
   public function brand_category($data)  {
      $Brand_Category = new Brand_Category();
      $CategoryModel = new CategoryModel();
      if( $data != null){
          
         if($CategoryModel->insert($data)){
          $category_id  =  $CategoryModel->orderBy("id","desc")->first();
          $brand2 = [
             'brand_id'=>$category_id['brand_id'],
             'brand_category'=>$category_id['id']
             ];
          if($Brand_Category->insert($brand2)){
              return true;
          }
         }
         
      }
       return false;
     
   } 
     
    
    
    
    
}
