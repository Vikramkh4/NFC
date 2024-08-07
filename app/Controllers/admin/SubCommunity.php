<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\SubCommunityModel;
use App\Models\CommunityModel;

class SubCommunity extends BaseController
{
    public $subcommunityModel;
    public $CommunityModel;

     public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->subcommunityModel = new SubCommunityModel();
    

  }
public function view_subcommunity(){
    $data['title'] = "Admin | Sub Community";
    $data['page_name'] = "Sub Community View";
    $data['page'] = ADMIN . "subcomunity_tb";
   
   
    
    $community_id = $this->request->getGetPost("community_id");
    $bra = new CommunityModel();
    $list  = $bra->find($community_id);
    if(isset($list) && !empty($list)){
    $data['community']=$this->subcommunityModel->where("community_id",$community_id)->find();
    }else{
     return view($data['page'],$data);
    }
  return view($data['page'],$data);
   
}

public function add_subcommunity() {
        $data['title'] = "Admin | Add SubCommunity";
        $data['page_name'] = "addsubcommunity";

       
        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('image');
            $community_id = $this->request->getGetPost("community_id");
           
            $newName = "";
            $logoFile = $this->request->getFile('image');
            if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                $newName = $logoFile->getRandomName();
                $logoFile->move(IMAGE_CUMMUNITY, $newName);
            }

           
            $dataToAdd = [
                'community_id' => $community_id,
                'image' => $newName,
                'sub_name' => $this->request->getPost('sub_name'),
                'sub_description' => $this->request->getPost('sub_description'),
                'tags' => $this->request->getPost('tags'),
                'createdby' => $this->request->getPost('createdby'),
               'create_date' => $this->request->getPost('createddate'),

            ];
            if ($this->subcommunityModel->insert($dataToAdd)) {                
                session()->setFlashdata('success', 'SubCommunity successfully added');
                return redirect()->to(base_url("admin/subcommunity?community_id={$community_id}"));
            } else {
                $data['errors'] = $this->subcommunityModel->errors();
                $data['page'] = ADMIN . "addsubcommunity";
                return view($data['page'], $data);
            }
        } else {
            $data['page'] = ADMIN . "addsubcommunity";
            return view($data['page'], $data);
        }
   
           
        } 
    





  
public function update_viewcommunity($id){
    $data['title'] = "Admin | Update SubCommunity";
    $data['page_name'] = "update_subcommunity";

    // Fetch the sub-community data from the database based on $id
    $subcommunity = $this->subcommunityModel->find($id);

    // Check if the sub-community exists
    if (!$subcommunity) {
        // Handle the case where the sub-community does not exist, maybe redirect or show an error message
        return redirect()->back()->with('error', 'SubCommunity not found.');
    }

    if ($this->request->getMethod() == 'POST') {
        $newData = [
            'sub_name' => $this->request->getPost('sub_name'),
            'sub_description' => $this->request->getPost('sub_description'),
            'tags' => $this->request->getPost('tags'),
            'createdby' => $this->request->getPost('createdby'),
            'create_date' => $this->request->getPost('create_date'),
        ];

        // Handle image upload if a new image is provided
        if ($logoFile = $this->request->getFile('image')) {
            if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                // Delete the old image if exists
                if ($subcommunity['image'] && file_exists(IMAGE_CUMMUNITY . $subcommunity['image'])) {
                    unlink(IMAGE_CUMMUNITY . $subcommunity['image']);
                }
                // Move and save the new image
                $newName = $logoFile->getRandomName();
                $logoFile->move(IMAGE_CUMMUNITY, $newName);
                $newData['image'] = $newName;
            }
        }

        // Update the sub-community data
       if ($this->subcommunityModel->update($id, $newData)) {
    session()->setFlashdata('success', 'SubCommunity successfully updated');
    return redirect()->to(AD . "subcommunity?community_id=".$subcommunity['community_id']);
} else {
    $data['errors'] = $this->subcommunityModel->errors();
    return redirect()->to(current_url());
}

    } else {
        // Pass the sub-community data to the view for rendering
        $data['subcommunity'] = $subcommunity;
        $data['page'] = ADMIN .'editsubcommunity'; // Assuming this is the view file name
        return view($data['page'], $data);
    }
}

public function deletecummunity($id = null)
{
    $subCommunityModel = new SubCommunityModel(); // Initialize the SubCommunityModel

    if ($id && $subCommunityModel->delete($id)) { // Use the initialized model to delete the community
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
    if($this->request->getMethod() == 'post'){
    
  } else {
        $data['page'] = ADMIN . "communitytable";
        return view($data['page'], $data);
    } 
         
  }
    
    

}
