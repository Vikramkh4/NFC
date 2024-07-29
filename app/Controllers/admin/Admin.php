<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


use App\Models\UserModel;
class Admin extends BaseController
{   
     
     public $empModel;
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
        $this->empModel = new UserModel();
      
      

    }
   public function index(){
      
    $data['title'] = "Admin | Dashboard";
    $data['page'] = ADMIN."index";
    $data['page_name'] = "Dashboard ";
//    
    
    
    
   
    return view($data['page'],$data);
   }}