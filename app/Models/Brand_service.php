<?php

namespace App\Models;

use CodeIgniter\Model;


class Brand_service extends Model
{
    protected $table = 'brand_service';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'brand_id',
        'service_id',
  ];
    protected $returnType = 'array';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false; 
    
   
  
public function brand_service($data)
{
    $brand = new Brand_service();
    $serviceModel = new ServiceModel();
    if (!empty($data)) {
        $serviceInserted = $serviceModel->insert($data);
        if ($serviceInserted) {
            $latestService = $serviceModel->orderBy('id', 'desc')->first();
          
            $brand2 = [
                'brand_id' => $latestService['brand_id'],
                'service_id' => $latestService['id']
            ];
            $brandInserted = $brand->insert($brand2);

            if ($brandInserted) {
                return true;
            }
        }
    }

    return false;
}

    
    
    
}
