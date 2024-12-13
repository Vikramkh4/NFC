<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ServiceModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\Brand_service;
use App\Models\Brand_product;
use App\Models\CategoryModel;
use App\Models\BlogModel;
use App\Models\EnquiryModel;

use App\Models\MarketModel;
use App\Models\CommunityModel;
class Api extends BaseController
{     
    public $empModel;
    public $service;
    public $brand;
    public $product;
    public $brand_ser;
    public $brand_pro;
    public $validation;
    public function __construct()
    {
        // if (session()->get('role') != "admin") {
        //     echo 'Access denied';
        //     exit;
        // }
       $this->empModel = new UserModel();
       $this->service = new ServiceModel();
       $this->brand =  new BrandModel();
        $this->product =  new ProductModel();
        $this->brand_ser= new Brand_service();
        $this->brand_pro=new Brand_product ();
        $this->CategoryModel=new CategoryModel();
        $this->MarketModel=new MarketModel();
        $this->CommunityModel=new CommunityModel();
      $this->validation = \Config\Services::validation();

    }
    
public function authentication_check()
{
    $token = $this->request->getVar("token_key");
    if (!$token) {
        return $this->response->setJSON(['error' => true, 'message' => 'Token not provided']);
    }
    
      try {

        $user = $this->empModel->where("token_key", $token)->first();
  
        if ($user && $user['token_key'] === $token) {
            return true;
        } else {
            return false;
        }
    } catch (\Exception $e) {
        return false;
    }
}

public function logout()
{
   
    $token = $this->request->getVar("token_key");

    if (!$token) {
        return $this->response->setJSON(['error' => true, 'message' => 'Token not provided']);
    }

    try {
   
        $user = $this->empModel->where("token_key", $token)->first();
    
        if ($user) {
           
            $this->empModel->update($user['user_id'], ['token_key' => null]);
        
          
            return $this->response->setJSON(['error' => false, 'message' => 'Logout successful']);
        } else {
           
            return $this->response->setJSON(['error' => true, 'message' => 'Invalid token']);
        }
    } catch (\Exception $e) {
     
        return $this->response->setJSON(['error' => true, 'message' => 'An error occurred while logging out']);
    }
}

    
    public function login_api()
    {
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        $this->validation->setRules($validationRules);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                "error" => true,  
                'message' => $this->validation->getErrors()
            ]);
        }

        $validatedData = $this->validation->getValidated();
        $userModel = new UserModel();
        $user = $userModel->where('email', $validatedData['email'])->first();

        if ($user) {
            //password_verify($validatedData['password'], $user['password'])
            if ($validatedData['password'] ==  $user['password']) {
              
                $key = [
                 "token_key"=>rand(10,100000000000)
                ];
                
                $userModel->update($user['user_id'] ,$key);
             $updateduser = $userModel->where('email', $validatedData['email'])->first();
             $kavita_object = [
                    "user_id"=> $updateduser['user_id'],
                    "name"=> $updateduser['name'],
                    "email" => $updateduser['email'],
                    "phone_no"=> $updateduser['phone_no'],
                    "token_key"=> $updateduser['token_key'],
                    "role"=> "admin",
                 ];
             
                return $this->response->setJSON([
                    'message' => 'Login successful',
                    'data' => $kavita_object
                ]);
            }
            return $this->response->setJSON([
                "error" => true,
                'message' => "Invalid Credentials"
            ]);
        }

        return $this->response->setJSON([
            "error" => true,
            'message' => "Invalid Credentials"
        ]);
    }
   
  
    public function addenquirynfc()
    {
        $model = new EnquiryModel();
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'email'    => 'required|valid_email',
                'name'     => 'required|min_length[3]',
                'topic'    => 'required|min_length[3]',
                'comment'  => 'required|min_length[10]',
                'brand_id' => 'required|integer|is_not_unique[brand.id]',
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $validation->getErrors()
                ]);
            }

            $dataToAdd = [
                'email'   => $this->request->getPost('email'),
                'name'    => $this->request->getPost('name'),
                'topic'   => $this->request->getPost('topic'),
                'comment' => $this->request->getPost('comment'),
                'brand_id' => $this->request->getPost('brand_id'),
            ];

            if ($model->save($dataToAdd)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Enquiry submitted successfully.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to submit enquiry.'
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }

    public function addreviewnfc()
    {
        $blogModel = new BlogModel ();
        $validation = \Config\Services::validation();

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'description' => 'required|min_length[3]|max_length[255]',
                'rating' => 'required|integer|greater_than[0]|less_than[6]',
                'brand_id' => 'required|integer|is_not_unique[brand.id]',
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $validation->getErrors()
                ]);
            }

            $data = [
                'description' => $this->request->getPost('description'),
                'rating' => $this->request->getPost('rating'),
                'brand_id' => $this->request->getPost('brand_id'),
            ];

            $file = $this->request->getFile('blog_image');
            if ($file && $file->isValid()) {
                $newName = $file->getRandomName();
                $file->move('uploads/blog_image/', $newName);
                $data['blog_image'] = $newName;
            }

            if ($blogModel->save($data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Review added successfully.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to add review.'
                ]);
            }
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Invalid request method.'
        ]);
    }

  public function signup_nfc(){
          
          $validationRules = [
            'name' => 'required',
            'phone_no'=>'required|max_length[11]',
            'email' => 'required|valid_email|is_unique[_users_.email]',
            'password' => 'required',
            '  '=> 'required|matches[password]'
        ];
        $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
        $validatedData = $this->validation->getValidated();
        $data  =  [
              'name'=>$validatedData['name'],
              'phone_no'=>$validatedData['phone_no'],
              'email'=>$validatedData['email'],
              'password'=>$validatedData['password'],
              'role'=>"user",
              ];              
       if($this->empModel->insert($data)){
       return $this->response->setJSON(['error' => false,"message"=>"Sign Up Successfully"]);        
       }else{
       return $this->response->setJSON(['error' => true,"message"=>"Sign Up Failed"]);           
       }   
    
          
 }
    
      public function forget_password_nfc(){
       $validationRules = [
            'email'=>'required',
            'password' => 'required',
            'confirm_password'=> 'required|matches[password]'
        ];
        $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
        $validatedData = $this->validation->getValidated();
        $user = $this->empModel->where('email', $validatedData['email'])->first();
        if($user != null){
           $data  =  [
              'email'=>$validatedData['email'],
              'password'=>$validatedData['password'],
              ];  
         if($this->empModel->update($user['user_id'],$data)){
           return $this->response->setJSON(['error' => false,"message"=>"Password Changed Successfully"]);        
           }else{
           return $this->response->setJSON(['error' => true,"message"=>"Failed"]);           
           }  
        
        }
      
      }
      
      
 public function getbyid_services_nfc(){
   
        //  if($this->authentication_check())
        //  {
        //      return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
        //  }
          $validationRules = [
            'id' => 'required',
            ];
          $this->validation->setRules($validationRules);
          if (!$this->validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
           }     
          $validatedData = $this->validation->getValidated();
          $data   =  $this->service->where("id",$validatedData['id'])->first();
          if(empty($data) && $data == null){
                return $this->response->setJSON(['error' => false,"message"=>"Service is empty or not found"]); 
          }
          $data['image'] = base_url(IMAGE_PATH."/".$data['image']);
           return $this->response->setJSON(['error' => false,"data"=>$data]); 
        
}
          

    public function getall_services_nfc(){
        
          $data   =  $this->service->findAll();
          if(empty($data) && $data == null){
                return $this->response->setJSON(['error' => false,"message"=>"Service is empty"]); 
          }
          foreach($data as$key=> $row){
              if(!empty($row['image'])){
                    $data[$key]['image'] = base_url(IMAGE_PATH."/".$row['image']);
              }else{
                    $data[$key]['image'] = "";
              }
        
          }
           return $this->response->setJSON(['error' => false,"data"=>$data]); 
          
      }
      
// IMAGE_PATH     
      public function add_service_nfc(){
        if(!$this->authentication_check())
          {
        $validationRules = [
            'brand_id' => 'required',
            // 'image' => 'required''uploaded[image]|max_size[image,1024]|is_image[image]',
            'name' => 'required',
            'details' => 'required'
        ];
        $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
        $validatedData = $this->validation->getValidated();
            $file  = $this->request->getFile("image");
            $newname = "";
            if($file &&!empty($file->isValid())){
            $newname  =$file->getRandomName();
            $file->move(IMAGE_PATH,$newname);    
            }
     
           $data=[
               'brand_id'=>$validatedData['brand_id'],
               'image'=>$newname,
               'name'=>$validatedData['name'],
               'details'=>$validatedData['details'],
               ];  
       
         if($this->brand_ser->brand_service($data)){
             return $this->response->setJSON(['error' => false,"message"=>"Service add Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Service add Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
          }
          
      }
      public function update_service_nfc(){
        if(!$this->authentication_check())
          {
        $validationRules = [
            'service_id'=>'required',
            'brand_id' => 'required',
            'name' => 'required',
            'details' => 'required'
        ];
        $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
        $validatedData = $this->validation->getValidated();
            // $service_id =  $this->request->getVar("id");
            $file  = $this->request->getFile("image");
            $newname = "";
            // if(!empty($file)){
            // $newname  =$file->getRandomName();
            // $file->move(IMAGE_PATH,$newname);    
            // }
            if (!empty($file) && $file->isValid() && !$file->hasMoved()) {
                $newname = $file->getRandomName();
                $file->move(IMAGE_PATH, $newname);
            }
           if(empty($newname)){
            $data=[
               'brand_id'=>$validatedData['brand_id'],
            //   'image'=>$newname,
               'name'=>$validatedData['name'],
               'details'=>$validatedData['details'],
               ];   
              }else{
               $data=[
               'brand_id'=>$validatedData['brand_id'],
               'image'=>$newname,
               'name'=>$validatedData['name'],
               'details'=>$validatedData['details'],
               ];   
                  
                  
              }
            
       
         if($this->service->update($validatedData['service_id'],$data)){
             return $this->response->setJSON(['error' => false,"message"=>"Service Updated Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Service Updated Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
          }
          
      }
      
      public function delete_service_nfc(){
           if(!$this->authentication_check())
        {
        $validationRules = [
           'service_id' => 'required',
             ];
             $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()){
             return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
        
      
                if($this->service->delete($validatedData['$service_id'])){
             return $this->response->setJSON(['error' => false,"message"=>"Service delete Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Service deletion Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);
      }
      }
      
      
      public function add_brand_nfc(){
           if(!$this->authentication_check())
          {
        $validationRules = [
            'u_id' => 'required|max_length[12]',
            'name' => 'required|max_length[255]',
            'email' => 'required|max_length[255]',
            'phone_no' => 'required|max_length[12]',
            'address' => 'required|max_length[255]',
            'website' => 'required|valid_url',
            'google_review'=> 'required|valid_url'
        ];
         $this->validation->setRules($validationRules);
          if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
            $file  = $this->request->getFile("logo");
            $newname = "";
            if(!empty($file)){
            $newname  =$file->getRandomName();
            $file->move(IMAGE_PATH,$newname);    
            }
            $data=[
               
                 'u_id'=>$validatedData['u_id'],
                 'logo'=>$newname, 
                 'name'=>$validatedData['name'],
                 'email'=>$validatedData['email'],
                 'phone_no'=>$validatedData['phone_no'],
                 'address'=>$validatedData['address'],
                 'website'=>$validatedData['website'],
                 'google_review'=>$validatedData['google_review'],
                 
                 ];
                if($this->brand->insert($data)){
             return $this->response->setJSON(['error' => false,"message"=>"Brand add Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Brand add Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);   
          }
          }
          
          
          public function update_brand_nfc(){
              if(!$this->authentication_check())
        {
        $validationRules = [
            'brand_id'=>"required",
            'user_id' => 'required|max_length[12]',
            'name' => 'required|max_length[255]',
            'email' => 'required|max_length[255]|valid_email',
            'phone_no' => 'required|max_length[12]',
            'address' => 'required',
            'website' => 'required|valid_url',      
            'google_review' => 'required|valid_url'
            ];
             $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
          $validatedData = $this->validation->getValidated();
           $logoFile  = $this->request->getFile("logo");
           $newname = "";
           
            if (!empty($logoFile) && $logoFile->isValid() && !$logoFile->hasMoved()) {
                $newname = $logoFile->getRandomName();
                $logoFile->move(IMAGE_PATH, $newname);
            }
            
            if(empty($newname)){
            $data=[
                 'u_id'=>$validatedData['user_id'],
                 'name'=>$validatedData['name'],
                 'email'=>$validatedData['email'],
                 'phone_no'=>$validatedData['phone_no'],
                 'address'=>$validatedData['address'],
                 'website'=>$validatedData['website'],
                 'google_review'=>$validatedData['google_review'],
               
              ];   
              }
              else{
              $data=[
                'u_id'=>$validatedData['user_id'],
                 'logo'=>$newname, 
                 'name'=>$validatedData['name'],
                 'email'=>$validatedData['email'],
                 'phone_no'=>$validatedData['phone_no'],
                 'address'=>$validatedData['address'],
                 'website'=>$validatedData['website'],
                 'google_review'=>$validatedData['google_review'],
               
              ]; 
              }
              if($this->brand->update($validatedData['brand_id'],$data)){
             return $this->response->setJSON(['error' => false,"message"=>"Brand Updated Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Brand Updated Failed"]);           
          
          }
              
          }      
          else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
          }
                  
                  
             
          }

       public function delete_brand_nfc(){
            if(!$this->authentication_check())
        {
        $validationRules = [
            'brand_id' => 'required',
     
            ];
             $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()){
             return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
        
      
                if($this->brand->delete($validatedData['brand_id'])){
             return $this->response->setJSON(['error' => false,"message"=>"Brand delete Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Brand deletion Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);   
          }
       

        
       }  
      
       public function add_product_nfc(){
            if(!$this->authentication_check()){
                 $validationRules =[
                     'brand_id' => 'required',
                      //'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
                     'product' => 'required',
                     'details' => 'required',
                     'price' => 'required',
                     ];
                     $this->validation->setRules($validationRules);
          if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
            $file  = $this->request->getFile("image");
            $newname = "";
            if(!empty($file)){
            $newname  =$file->getRandomName();
            $file->move(IMAGE_PATH,$newname);    
            }
             $data=[
                'brand_id'=>$validatedData['brand_id'],
                'image'=>$newname, 
                 'product'=>$validatedData['product'],
                 'details'=>$validatedData['details'],
                 'price'=>$validatedData['price'],
                 ];
                  if($this->brand_pro->brand_product($data)){
             return $this->response->setJSON(['error' => false,"message"=>"Product  add Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Product add Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
          }
          {
            
            }

       }
       public function getbrandnfc()
{
    
        $validationRules = [
            'brand_id' => 'required',
        ];
        $this->validation->setRules($validationRules);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }

        $validatedData = $this->validation->getValidated();
        $brand = $this->brand->where('id', $validatedData['brand_id'])->first();

        if (empty($brand)) {
            return $this->response->setJSON(['error' => true, "message" => "Brand not found"]);
        }

        $brand['logo'] = base_url(IMAGE_PATH . "/" . $brand['logo']);
        return $this->response->setJSON(['error' => false, "data" => $brand]);
   
}

public function getuserprofilenfc()
{
    
        $validationRules = [
            'user_id' => 'required',
        ];
        $this->validation->setRules($validationRules);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }

        $validatedData = $this->validation->getValidated();
        $user = $this->empModel->where('user_id', $validatedData['user_id'])->first();

        if (empty($user)) {
            return $this->response->setJSON(['error' => true, "message" => "User not found"]);
        }

        return $this->response->setJSON(['error' => false, "data" => $user]);
   
}

public function getmarketnfc()
{
   
        $validationRules = [
            'market_id' => 'required',
        ];
        $this->validation->setRules($validationRules);

        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }

        $validatedData = $this->validation->getValidated();
        $market = $this->MarketModel->where('id', $validatedData['market_id'])->first();

        if (empty($market)) {
            return $this->response->setJSON(['error' => true, "message" => "Market not found"]);
        }

        return $this->response->setJSON(['error' => false, "data" => $market]);
    
   
}
 public function update_product_nfc()
{
    if(!$this->authentication_check())
        {
        $validationRules = [
            'product_id' => 'required',
            'brand_id' => 'required',
                      //'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            'product' => 'required',
            'details' => 'required',
             'price' => 'required',
                      ];
             $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
           $file  = $this->request->getFile("image");
           $newname = "";
           
            if (!empty($file) && $file->isValid() && !$file->hasMoved()) {
                $newname = $file->getRandomName();
                $file->move(IMAGE_PATH, $newname);
            }
             
            if(empty($newname)){
            $data=[
                  'brand_id' => $validatedData['brand_id'],
                  'product' => $validatedData['product'],
                  'details' => $validatedData['details'],
                  'price' => $validatedData['price'],
                 
               
              ];   
              }
              else{
              $data=[
                'brand_id' => $validatedData['brand_id'],
                 'image'=>$newname,
                'product' => $validatedData['product'],
                'details' => $validatedData['details'],
                 'price' => $validatedData['price'],
                ]; 
              }
              if($this->product->update($validatedData['product_id'],$data)){
             return $this->response->setJSON(['error' => false,"message"=>"Product Updated Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Product Updated Failed"]);           
          }
               }      
          else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);          
          }
            
}

    public function delete_product_nfc(){
              
    if(!$this->authentication_check())
        {
        $validationRules = [
            'product_id' => 'required',
     
            ];
             $this->validation->setRules($validationRules);
        if (!$this->validation->withRequest($this->request)->run()){
             return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
        }
         $validatedData = $this->validation->getValidated();
         if($this->product->delete($validatedData['product_id'])){
             return $this->response->setJSON(['error' => false,"message"=>"Product delete Successfully"]);        
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Product deletion Failed"]);           
          }      
          }else{
             return $this->response->setJSON(['error' => true,"message"=>"Invalid"]);   
          }
}
public function getall_brand()
{
   
    // if (!$this->authentication_check()) {
    //     return $this->response->setJSON(['error' => true, "message" => "Invalid"]);
    // }
    
 
    $brands = $this->brand->findAll();
    
    if ($brands) {
        foreach ($brands as &$row) {
          
            $user = [];
            $market = [];
            try {
                   if(!empty($row['u_id'])){
                $single = $this->empModel->find($row['u_id']);
                $row['u_id'] = $single;
                   }
            } catch (\Exception $e) {
                $row['u_id'] = [];
            }
            try {
                 if(!empty($row['market'])){
                $marketas = $this->MarketModel->find($row['market']);
                $row['market'] = $marketas;
                 }
            } catch (\Exception $e) {
               
                $row['market'] = [];
            }
            try {
                if(!empty($row['category'])){
                $category = $this->CategoryModel->find($row['category']);
                $row['category'] = $category;
                }
            } catch (\Exception $e) {
               
                $row['category'] = [];
            }
            try {
                $arr  =[];
                foreach($brands as $r){
                   $product =  $this->product->where("brand_id",$r['id'])->first();
                   $arr[] = $product; 
                }
                $row['product'] = $arr;
              
            } catch (\Exception $e) {
               
                $row['product'] = [];
            }
            try { 
                $arrs  =[];
                foreach($brands as $r){
                   $service =   $this->service->where("brand_id",$r['id'])->first();
                   $arrs[] = $product; 
                }
                $row['service'] = $arrs;
              
            } catch (\Exception $e) {
               
                $row['service'] = [];
            }
        } 
   
            
      return $this->response->setJSON(['error' => false, 'data' => $brands]);
    } else {
      return $this->response->setJSON(['error' => true, 'message' => 'No brands found']);
    }
}

 
public function getbyid()
{
    $validationRules = [
        'brand_id' => 'required|numeric', // Assuming brand_id is numeric
    ];

    $this->validation->setRules($validationRules);

    if (!$this->validation->withRequest($this->request)->run()) {
        // Validation failed, return validation errors
        return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
    } else {
        // Validation passed, return the validated brand ID
        $validatedData = $this->validation->getValidated();
        $data = $this->brand->where("id",$validatedData['brand_id'])->first();
        if(!$data){
        return $this->response->setJSON(['error' => true, 'brand_id' => "Brand not found"]);        
        }else{
        $user  =     $this->empModel->where("user_id",$data['u_id'])->first();
        $data['u_id'] =   $user['name'];  
        return $this->response->setJSON(['error' => false, 'data' => $data]);        
        }
        return $this->response->setJSON(['error' => true, 'brand_id' => $validatedData['brand_id']]);
        
    }
}
public function getallproduct()
{
    
        // Assuming $this->product is an instance of the ProductModel
        $products = $this->product->findAll(); // Retrieve all products from the database
        
        // Check if any products were found
        if ($products) {
            return $this->response->setJSON(['error' => false, 'data' => $products]);
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'No products found']);
        }
   
}

 public function getbyidproduct()
{
    $validationRules = [
        'product_id' => 'required|numeric', // Assuming product_id is numeric
    ];
   
    $this->validation->setRules($validationRules);

    if (!$this->validation->withRequest($this->request)->run()) {
        // Validation failed, return validation errors
        return $this->response->setJSON(['errors' => $this->validation->getErrors()]);
    } else {
        // Validation passed, return the validated product ID
        $validatedData = $this->validation->getValidated();
  
        // Assuming $this->product is an instance of the ProductModel
        $product = $this->product->find($validatedData['product_id']);
        
        if (!$product) {
            return $this->response->setJSON(['error' => true, 'message' => 'Product not found']);
        } else {
            // Assuming $this->brand is an instance of the BrandModel
            $brand = $this->brand->find($product['brand_id']);
            if (!$brand) {
                return $this->response->setJSON(['error' => true, 'message' => 'Brand not found for this product']);
            }
            
            // Assuming $this->empModel is an instance of the EmployeeModel
            $user = $this->empModel->where("user_id", $brand['u_id'])->first();
            if (!$user) {
                return $this->response->setJSON(['error' => true, 'message' => 'User not found for this brand']);
            }
            
            $product['brand_name'] = $brand['name'];
            $product['user_name'] = $user['name'];
            
            return $this->response->setJSON(['error' => false, 'data' => $product]);
        }
    }
}

  
     public function homescreacndata()
{
   
    // if ($this->authentication_check() !== true) {
    //     return $this->response->setJSON(['error' => true, 'message' => 'Invalid']);
    // }
         
    $complete = [];

    try {
        // Fetch all categories, markets, and communities
        $all_category = $this->CategoryModel->findAll();
        $all_market = $this->MarketModel->findAll();
        $all_community = $this->CommunityModel->findAll();

        $complete = [
            'category' => $all_category,
            'market' => $all_market,
            'community' => $all_community
        ];

        
        return $this->response->setJSON(['error' => false, 'data' => $complete]);
    } catch (\Exception $e) {
 
        return $this->response->setJSON(['error' => true, 'message' => 'An error occurred while fetching data.']);
    }
}
public function getbanner()
{
    // Fetch banner data using the model
    $bannerModel = new \App\Models\BannerModel(); // Assuming you have a BannerModel
    $banner = $bannerModel->findAll();

    // Loop through each banner item to update the image path
    foreach ($banner as &$row) { // Use reference (&) to modify the original array
        if (!empty($row['image'])) {
            // Update the image path with the full URL
            $row['image'] = base_url(IMAGE_PATH_BANNER . "/" . $row['image']);
        }
    }

    // Return the response as JSON
    return $this->response->setJSON(['error' => false, 'data' => $banner]);
}



        
}