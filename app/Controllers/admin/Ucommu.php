<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;

use App\Models\SubCommunityModel;
use App\Models\UserComModel;
use App\Models\CommunityModel;

use App\Models\UserModel;


class Ucommu extends BaseController
{
    public $subcommunityModel;
    public $usermodel;
    public $usercomodel;
    public $communitymodel;
    

     public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->subcommunityModel = new SubCommunityModel();
      $this->usermodel = new UserModel();
      $this->usercomodel = new UserComModel();
      $this->communitymodel = new CommunityModel();
    

  }

public function table(){
    $data['title'] = "Admin | User Community table";
    $data['page_name'] = "User Community Table";
  $data['data'] = $this->usercomodel->findAll();
   $data['page'] = ADMIN . "relation_usc_table"; // Assuming this is the view file name
    return view($data['page'], $data); 
}  
  
  
  
public function view_usercommunity(){
    $data['title'] = "Admin | User Community";
    $data['page_name'] = "User Community View";
    $data['users'] = $this->usermodel->findAll(); // Remove the $ sign before the variable name
    $data['subcommunities'] = $this->subcommunityModel->findAll(); // Remove the $ sign before the variable name
    $data['communities'] = $this->communitymodel->findAll(); // Remove the $ sign before the variable name
    
    if($this->request->getMethod() == 'POST'){
       
  
    $validation = \Config\Services::validation();


    $validationRules = [
        'user_id' => 'required|numeric',
        'community_id' => 'required|numeric'
    ];

  
    $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required.'
        ],
        'community_id' => [
            'numeric' => 'Community ID must be a number.'
        ]
    ];

  
    $validation->setRules($validationRules, $validationMessages);
    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('validation', $validation);
    }
   

    $data = [
        'user_id' => $this->request->getPost('user_id'),
        'community_id' => $this->request->getPost('community_id'),
        'subcom_id' => $this->request->getPost('subcom_id')
    ];

    if($this->usercomodel->insert($data)){
          session()->setFlashdata('success', 'Data saved successfully!');
          return redirect()->to(AD.'cummunitytable'); 
    }else{
         $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
        return view($data['page'], $data);
    }

  
       
       
    } else {
        $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
        return view($data['page'], $data);
    }
}

public function update_cummnunity($id){
        $data['title'] = "Update User Community  | User Community";
    $data['user']    = $this->usercomodel->find($id);
    $data['page_name'] = "User Community View";
    $data['users'] = $this->usermodel->findAll(); 
    $data['subcommunities'] = $this->subcommunityModel->findAll(); 
    $data['communities'] = $this->communitymodel->findAll(); 
    
    if($this->request->getMethod() == 'POST'){
        
        $validation = \Config\Services::validation();


    $validationRules = [
        'user_id' => 'required|numeric',
        'community_id' => 'required|numeric'
    ];

  
    $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required.'
        ],
        'community_id' => [
            'numeric' => 'Community ID must be a number.'
        ]
    ];

  
    $validation->setRules($validationRules, $validationMessages);
    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('validation', $validation);
    }
   

    $data = [
        'user_id' => $this->request->getPost('user_id'),
        'community_id' => $this->request->getPost('community_id'),
        'subcom_id' => $this->request->getPost('subcom_id')
    ];

    if($this->usercomodel->update($id,$data)){
          session()->setFlashdata('success', 'Data updated successfully!');
          return redirect()->to(AD.'cummunitytable'); 
    }else{
         $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
        return view($data['page'], $data);
    }
    

    
} else {
        $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
        return view($data['page'], $data);
    }  
}



}

?>