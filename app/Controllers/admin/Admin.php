<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


use App\Models\UserModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;
use App\Models\CommunityModel;
use App\Models\CategoryModel;
class Admin extends BaseController
{   
     
     public $empModel;
     public $brand;
     public $productModel;
     public $serviceModel;
     public $categoryModel;
     public $CommunityModel;
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
        $this->empModel = new UserModel();
        $this->brand = new BrandModel();
        $this->productModel = new ProductModel();
         $this->serviceModel = new ServiceModel();
         $this->categoryModel = new CategoryModel();
         $this->CommunityModel = new CommunityModel();
      

    }
   public function index(){
      
    $data['title'] = "Admin | Dashboard";
    $data['page'] = ADMIN."index";
    $data['page_name'] = "Dashboard ";
//    
$data['users'] = $this->empModel->builder()->countAll();
$data['primary'] = $this->empModel->builder()->where("role","primary")->countAllResults();
 $data['brands'] = $this->brand->builder()->countAll();
 $data['product'] =  $this->productModel->builder()->countAll();
 $data['service'] =  $this->serviceModel->builder()->countAll();
    
    
   
    return view($data['page'],$data);
   }}