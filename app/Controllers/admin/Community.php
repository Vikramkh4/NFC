<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


use App\Models\BrandModel;
use App\Models\CommunityModel;
use App\Models\SubCommunityModel;
use App\Models\UserModel;


class Community extends BaseController
{   
     
  public $brandModel;
  public $subcomunityModel;
  public $CommunityModel;

  public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->brandModel = new BrandModel();
      $this->CommunityModel = new CommunityModel();
     
      $this->subcomunityModel = new SubCommunityModel();
      
    

  }
  
public function view_subcommunity(){
    $data['title'] = "Admin | Sub Community";
    $data['page_name'] = "Sub Community View";
    $data['community'] = $this->subcomunityModel->findAll();
    
    if($this->request->getMethod() == 'POST'){
        // Handle form submission if needed
    } else {
        $data['page'] = ADMIN . "subcomunity_tb"; // Assuming this is the view file name
        return view($data['page'], $data);
    }
}

  
  public function add_cummunity(){
      
    $data['title'] = "Admin | Community";
    $data['page_name'] = "Community Add";
    $data['page'] = ADMIN . "add_cummunity";
    $data['community'] = $this->CommunityModel->findAll();
    $data['brand'] =  $this->brandModel->findAll();
   
    
    if($this->request->getMethod() == 'POST'){
$validation = \Config\Services::validation();    

        $setRules = [
            'name' => 'required|max_length[50]', 
            'location' => 'required|max_length[100]'
        ];
        
        if (! $this->validate($setRules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }   
     $data = [
        "name" => $this->request->getPost('name'),
        "brand_id" => $this->request->getPost('brand_id'),
       
        "description" => $this->request->getPost('description'),
        "image" => $this->request->getPost('image'),
        "location" => $this->request->getPost('location'),
        "numberofmembers" => $this->request->getPost('numberofmembers'),
        "ispublic" => $this->request->getPost('ispublic'),
        "createdby" => $this->request->getPost('createdby'),
        "createddate" => $this->request->getPost('createddate')
    ];
        
    
            $image = $this->request->getFile('image');
            if ($image->isValid() && !$image->hasMoved()) {
               $newName = $image->getRandomName();
               $image->move(IMAGE_CUMMUNITY, $newName);
                $data['image'] = $newName;
            } 
       
       
         if($this->CommunityModel->insert($data))
         {                    
            session()->setFlashdata('success', 'Community successfully added');
            return redirect()->to(AD."community"); 
        } else {
            $data['errors'] = $this->CommunityModel->errors();
            $data['page'] = ADMIN . "add_cummunity";
            return view($data['page'], $data);
        }
       
    
     }
    else {
    
    
    return view($data['page'], $data);     
   }
     
      
  }
  
public function update_communitys($id){
    $data['title'] = "Admin | Update Community";
    $data['page_name'] = "Update Community";
    $data['page'] = ADMIN . "update_cummunity";
    $data['brands'] =  $this->brandModel->findAll();

 if (empty($id)) {
        return redirect()->to(AD . "community")->with('errors', 'Community ID is required for update');
    }

    $data['community'] = $this->CommunityModel->find($id);
  

    if ($this->request->getMethod() == 'POST'){
        $validation = \Config\Services::validation();

        $setRules = [
            'name' => 'required|max_length[50]', 
            'location' => 'required|max_length[100]'
        ];
        
        if (!$this->validate($setRules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }   

  
        $formData = [
            "name" => $this->request->getPost('name'),
            "brand_id" => $this->request->getPost('brand_id'),
            "description" => $this->request->getPost('description'),
            "location" => $this->request->getPost('location'),
            "numberofmembers" => $this->request->getPost('numberofmembers'),
            "ispublic" => $this->request->getPost('ispublic'),
            "createdby" => $this->request->getPost('createdby'),
            "createddate" => $this->request->getPost('createddate')
        ];

        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(IMAGE_CUMMUNITY, $newName);
            $formData['image'] = $newName;
        } 

      
        if ($this->CommunityModel->update($id, $formData)) {                    
            session()->setFlashdata('success', 'Community updated successfully');
            return redirect()->to(AD."community"); 
        } else {
            session()->setFlashdata('error', 'Failed to update community');
        }
    }

    return view($data['page'], $data);     
}

public function deletecummunity($id = null)
    {
        
        if ($id && $this->CommunityModel->delete($id)) {
            $data = [
                'status' => 'success',
                'status_text' => 'Community has been deleted successfully',
                'status_icon' => 'success'
            ];
            session()->setFlashdata('success', 'Community deleted successfully');
        } else {
            $data = [
                'status' => 'error',
                'status_text' => 'Failed to delete Community',
                'status_icon' => 'error'
            ];
            session()->setFlashdata('error', 'Failed to delete Community');
        }
    
        
        return $this->response->setJSON($data);
    }


  
 public function viewtable() 
  {
    $data['title'] = "Admin | Community";
    $data['page_name'] = "Community Add";
    $data['community'] = $this->CommunityModel->findAll();
    if($this->request->getMethod() == 'POST'){
    
  } else {
        $data['page'] = ADMIN . "communitytable";
        return view($data['page'], $data);
    } 
         
  }
    
    

}
