<?php

namespace App\Controllers\hki;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\UserModel;

class Brand extends BaseController
{   
    protected $brandModel;
    protected $user_id;
    

    public function __construct()
    {
        if (session()->get('role') !== "vendor") {
            echo 'Access denied';
            exit;
        }
        $this->brandModel = new BrandModel();
         $this->user_id = session()->get('user_id');
    }

    public function viewBrand()
    {
        $data['title'] = "Primary | Brand";
        $data['page'] = VENDOR . "brand_table";
        $data['page_name'] = "Brand";
    
        // Corrected to use $this->user_id
        if (!$this->user_id) {
            // User ID not found, handle the error or redirect
            return redirect()->to('login'); // Redirect to login page or handle the error
        }
    
        // Load the User model and find the user by user_id
        $userModel = new UserModel();
        $user = $userModel->find($this->user_id);
    
        if (!$user) {
            // User not found, handle the error or redirect
            return redirect()->to('login'); // Redirect to login page or handle the error
        }
    
        // Query the BrandModel to get brands associated with the logged-in user
        $data['brand'] = $this->brandModel->where('u_id', $this->user_id)->findAll();
    
        return view($data['page'], $data);
    }
    public function addbrand()
    {
        $data['title'] = "Vendor | Brand";
        $data['page_name'] = "Brand";
        
        
        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('logo');
            $newName = '';
    
            if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
                $newName = $logoFile->getRandomName();
                $logoFile->move('./uploads', $newName);
            }
    
            $dataToAdd = [
                'u_id' => $this->request->getPost('user_id'),
                'logo' => $newName,
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('contact_no'),
                'address' => $this->request->getPost('address'),
                'website' => $this->request->getPost('website'),
                'google_review' => $this->request->getPost('google_review'),
                'whatsapp_no' => $this->request->getPost('whatsapp_no'),
                'twitter' => $this->request->getPost('twitter'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'others' => $this->request->getPost('others'),
                'enqlink' => $this->request->getPost('enqlink'),
            ];
        
            if ($this->brandModel->insert($dataToAdd)) {
                session()->setFlashdata('success', 'Brand successfully added');
                return redirect()->to(VD . "brand2");
            } else {
                $data['errors'] = $this->brandModel->errors();
                $data['page'] = VENDOR . "brand_add_view";
                return view($data['page'], $data);
            }
        } else {
            $data['page'] = VENDOR . "brand_add_view";
            return view($data['page'], $data);
        }
    }
    
    public function editbrand($id = null)
    {
        $data['title'] = "Vendor | Edit Brand";
        $data['page'] = VENDOR . "brand_edit";
        $data['page_name'] = "Brand";
    
        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('logo');
            $newName = '';
    
            if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
                $newName = $logoFile->getRandomName();
                $logoFile->move('./uploads', $newName);
            }
    
            $dataToEdit = [
                'user_id' => $this->request->getPost('user_id'),
                'logo' => $newName,
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('contact_no'),
                'address' => $this->request->getPost('address'),
                'website' => $this->request->getPost('website'),
                'google_review' => $this->request->getPost('google_review'),
                'whatsapp_no' => $this->request->getPost('whatsapp_no'),
                'twitter' => $this->request->getPost('twitter'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'others' => $this->request->getPost('others'),
                'enqlink' => $this->request->getPost('enqlink'),
            ];
    
            // Remove the logo key if no new logo is uploaded
            if (empty($newName)) {
                unset($dataToEdit['logo']);
            }
    
            if ($this->brandModel->update($id, $dataToEdit)) {
                session()->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(VD . "brand2?user_id=" . $this->request->getPost('user_id'));
            } else {
                session()->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            }
        }
    
        $data['brand'] = $this->brandModel->find($id);
        $data['errors'] = $this->brandModel->errors();
    
        return view($data['page'], $data);
    }
    

public function deletebrand($id = null)
    {
        
        if ($id && $this->brandModel->delete($id)) {
            $data = [
                'status' => 'success',
                'status_text' => 'Brand has been deleted successfully',
                'status_icon' => 'success'
            ];
            session()->setFlashdata('success', 'Brand deleted successfully');
        } else {
            $data = [
                'status' => 'error',
                'status_text' => 'Failed to delete brand',
                'status_icon' => 'error'
            ];
            session()->setFlashdata('error', 'Failed to delete brand');
        }
    
        
        return $this->response->setJSON($data);
    }
  
 public function get_allbrand(){
         $data['title'] = "All Brand | vendor ";
         $data['page_name'] = "Brand ";
        $data['brand'] =$this->brandModel->findAll();  
          
        return view("vendor/allbrand_table",$data);  
      }    
    
    
}
