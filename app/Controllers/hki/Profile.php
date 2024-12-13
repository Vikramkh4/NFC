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

    
    
    public function profileview()
    {
        $id = session()->get("id");  // Fetch the logged-in user ID
        $user = $this->empModel->find($id);  // Fetch the user's profile data
    
        // Fetch related brands, products, and services
        $brands = $this->brand->where('u_id', $id)->findAll();
        $brandIds = $brands ? array_column($brands, 'id') : [];
        $products = !empty($brandIds) ? $this->productModel->whereIn('brand_id', $brandIds)->findAll() : [];
        $services = !empty($brandIds) ? $this->serviceModel->whereIn('brand_id', $brandIds)->findAll() : [];
    
        // Prepare the data array
        $data = [
            'title' => "Vendor | Dashboard",
            'page' => VENDOR . "profile",
            'page_name' => "Profile",
            'profile' => $user,  // Include the user profile
            'brands' => $brands,
            'products' => $products,
            'services' => $services,
        ];
    
        return view($data['page'], $data);
    }
    
        
   
   
   
   public function update_profile(){
      
    $data['title'] = "vendor | Dashboard";
    $data['page'] = VENDOR."update_profile";
    $data['profile'] = $this->empModel->find(session()->get("id"));

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
            $data['page'] = VENDOR . "update_profile";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = VENDOR . "update_profile";
        return view($data['page'], $data);
    }
   
       
   }

}