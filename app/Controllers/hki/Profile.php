<?php

namespace App\Controllers\hki;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;

class Profile extends BaseController
{ 
    public $empModel;
    public $brand;
    public $productModel;
    public $serviceModel;
    
    public function __construct()
    {
        if (session()->get('role') != "vendor") {
            echo 'Access denied';
            exit;
        }
        
        $this->empModel = new UserModel();
        $this->brand = new BrandModel();
        $this->productModel = new ProductModel();
         $this->serviceModel = new ServiceModel();
    }

    
    
     public function profileview(){
         
        $data['title'] = "vendor | Dashboard";
        $data['page'] = VENDOR."profile";
        $data['page_name'] = "Profile ";
        $data["profile"] =   $this->empModel->find(session()->get("id"));
  
     return view($data['page'] , $data);
      
   }
   
   
   public function update_profile(){
      
    $data['title'] = "vendor | Dashboard";
    $data['page'] = VENDOR."profile";
         if($this->request->getMethod()=='POST'){
             
      $dataToAdd=[
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone_no' => $this->request->getPost('phone_no'),
        ];
         $id = $this->request->getPost('id');
        if ($this->empModel->update($id,$dataToAdd)) {                
            session()->setFlashdata('success', 'Updated  successfully');
            return redirect()->to("hki/profile"); 
        } else {
            $data['errors'] = $this->empModel->errors();
            $data['page'] = VENDOR . "adduser";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = VENDOR . "adduser";
        return view($data['page'], $data);
    }
   
       
   }

}