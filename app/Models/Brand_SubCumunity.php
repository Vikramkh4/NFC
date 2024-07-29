<?php

namespace App\Models;

use CodeIgniter\Model;

class Brand_SubCumunity extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'brand_cumunity_sub';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"brand_id",
		"cumunity_id",
		"sub_cumunity_id",
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
	
	
	public function add_subCummunity($data)
	{
	    $mainmodel  = new CommunityModel();
        $brandmodel  = new BrandModel();
	    $brandsubmodel  = new Brand_SubCumunity();
	    $submodel  = new SubCumunityModel();
	    if($data !=null){
	       $cummunity_id = $data['cumunity_id'];
	      if($submodel->insert($data)){
	        $sub_id  = $submodel->orderBy("id","desc")->first();
	        $Cummunitrydata  = $mainmodel->find($cummunity_id);
	          if($Cummunitrydata != null){
	            $brand_id  =  $Cummunitrydata['brand_id'];
	            
	            $newdata =[
	           "brand_id"=>$brand_id,
		     "cumunity_id"=>$cummunity_id,
	    	  "sub_cumunity_id"=>$sub_id
	                ];    
	            if($brandsubmodel->insert($newdata)){
	                return true;
	            }
	          }else{
	           $newdata =[
		     "cumunity_id"=>$cummunity_id,
	    	  "sub_cumunity_id"=>$sub_id
	                ];
	             if($brandsubmodel->insert($newdata)){
	                return true;
	            }     
	          }
	      }
	    }
	    return false;
	}
	
	
}