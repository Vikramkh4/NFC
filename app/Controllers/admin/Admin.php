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
   }
   public function viewEmp()
   { $data['title'] = "Admin | Dashboard";
    $data['page'] = ADMIN."usertable";
    $data['page_name'] = "User ";
    $data['users']=$this->empModel->whereIn('role',array("user","primary"))->findAll();
    $data['communities']=$this->CommunityModel->findAll();
    
     return view($data['page'],$data);
      
   }
 
   public function adduser(){
    $data['title'] = "Admin | User";
    $data['page'] = ADMIN."adduser";
    $data['page_name'] = "User ";
    if($this->request->getMethod()=='POST'){
      
        $dataToAdd=[
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone_no' => $this->request->getPost('phone_no'),
            'password' => $this->request->getPost('password'), 
            'role' => $this->request->getPost('role')
        ];
       
        if ($this->empModel->save($dataToAdd)) {                
            session()->setFlashdata('success', 'User successfully added');
            return redirect()->to(AD.'user'); 
        } else {
            $data['errors'] = $this->empModel->errors();
            $data['page'] = ADMIN . "adduser";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = ADMIN . "adduser";
        return view($data['page'], $data);
    }
    
   }

   public function edituser($id = null)
   {       $data['title'] = "Admin | User";
       $data['page'] = ADMIN."edituser";
       $data['page_name'] = "User ";
       if ($this->request->getMethod() == 'POST') {
           $data = [
               'name' => $this->request->getPost('name', FILTER_SANITIZE_STRING),
               'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
               'phone_no' => $this->request->getPost('phone_no', FILTER_SANITIZE_STRING),
               'password' => $this->request->getPost('password'), 
               'role' => $this->request->getPost('role', FILTER_SANITIZE_STRING)
               ];
   
           
   
           if ($this->empModel->update($id, $data)) {
               $session = session();
               $session->setFlashdata('success', 'Updated Successfully');
               return redirect()->to(AD.'user');
           } else {
               $session = session();
               $session->setFlashdata('error', 'Update Failed');
               return redirect()->to(current_url());
           }
       }
       $data["emp"]=$this->empModel->find($id);
       $data["errors"]=$this->empModel->errors();
   
         
       return view($data['page'], $data);
   
   
   }
   public function deleteuser($id = null)
       {
           
           if ($id && $this->empModel->delete($id)) {
              
               session()->setFlashdata('success', 'Employee deleted successfully');
           } else {
              
               session()->setFlashdata('error', 'Failed to delete employee');
           }
       
           
           return redirect()->to(base_url().'/admin/user');
       }
   
}
