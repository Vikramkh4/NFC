<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


use App\Models\BrandModel;
use App\Models\UserModel;
use App\Models\MarketModel;
use App\Models\CategoryModel;

class Brand extends BaseController
{   
  public $marketModel;  
  public $brandModel;
  public $categoryModel;
  public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->brandModel = new BrandModel();
      $this->marketModel = new MarketModel();
      $this->categoryModel = new CategoryModel();
    

  }
  public function addbrand()
{
    $data['title'] = "Admin | Brand";
    $data['page_name'] = "Brand ";
   $data['market']=$this->marketModel->findAll();
   $data['category']=$this->categoryModel->findAll();
   
    if ($this->request->getMethod() == 'POST') {
        
      
        $logoFile = $this->request->getFile('logo');
        $user_id = $this->request->getVar("user_id");;
        
   
       $newName = '';
        if(isset( $logoFile)){
        $newName = $logoFile->getRandomName();
        $logoFile->move('./uploads', $newName);
       
        }

        $dataToAdd = [
            'u_id'=>$user_id,
            'logo' => $newName,
            'market' => $this->request->getPost('market'),
            'category' => $this->request->getPost('category'),
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
            'others' => $this->request->getPost('others')
            ,'enqlink' => $this->request->getPost('enqlink'),
        ];
        
        
        if ($this->brandModel->insert($dataToAdd)) {                    
            session()->setFlashdata('success', 'Brand successfully added');
            return redirect()->to(AD."brtable?user_id=$user_id"); 
        } else {
            $data['errors'] = $this->brandModel->errors();
            $data['page'] = ADMIN . "brand_add_view";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = ADMIN . "brand_add_view";
        return view($data['page'], $data);
    }
}

public function viewBrand()
    {
        $data['title'] = "Admin | Brand";
        $data['page'] = ADMIN . "brand_table";
        $data['page_name'] = "Brand ";
        $user_id = $this->request->getVar("user_id");

        $userModel = new UserModel();
        $user = $userModel->find($user_id);

        if (isset($user) && !empty($user)) {
            $brands = $this->brandModel->where("u_id", $user_id)->findAll();

            // Fetch all markets and create a map of id => name
            $markets = $this->marketModel->findAll();
            $marketMap = [];
            foreach ($markets as $market) {
                $marketMap[$market['id']] = $market['name'];
            }
         $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category['id']] = $category['name'];
        }

            // Add market names to brands
            foreach ($brands as &$brand) {
                $brand['market'] = $marketMap[$brand['market']] ?? 'Unknown';
                $brand['category'] = $categoryMap[$brand['category']] ?? 'Unknown';
            }

            $data['brands'] = $brands;
        } else {
            $data['brands'] = []; // Ensure brands is set even if user is not found
        }

        return view($data['page'], $data);
    }
public function editbrand($id = null)
{
    $data['title'] = "Admin | Edit Brand";
    $data['page'] = ADMIN."brand_edit";
    $data['page_name'] = "Brand ";

    if ($this->request->getMethod() == 'POST') {

      
        $logoFile = $this->request->getFile('logo');
        $user_id = $this->request->getGetPost("user_id");
        
       if($logoFile->getSize()  != 0 && !empty($logoFile->getSize()) ){
      
        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move('./uploads', $newName);

            $dataToEdit = [
                'user_id'=>$user_id,
                'logo' => $newName, 
                 'address' => $this->request->getPost('address'),
                'website' => $this->request->getPost('website'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('contact_no'),
                'google_review' => $this->request->getPost('google_review'),
                'whatsapp_no' => $this->request->getPost('whatsapp_no'),
                'enqlink' => $this->request->getPost('enqlink'),
                'twitter' => $this->request->getPost('twitter'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'others' => $this->request->getPost('others')
            ];

            
            if ($this->brandModel->update($id, $dataToEdit)) {
                $session = session();
                $session->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(AD . "brtable?user_id=".$user_id);
                
            }
            else {
                $session = session();
                $session->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            } 
        }
    }else{
            $dataToEdit = [
                'user_id'=>$user_id,
                 'address' => $this->request->getPost('address'),
                'website' => $this->request->getPost('website'),
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('contact_no'),
                'google_review' => $this->request->getPost('google_review'),
                'whatsapp_no' => $this->request->getPost('whatsapp_no'),
                'enqlink' => $this->request->getPost('enqlink'),
                'twitter' => $this->request->getPost('twitter'),
                'instagram' => $this->request->getPost('instagram'),
                'facebook' => $this->request->getPost('facebook'),
                'others' => $this->request->getPost('others')
            ];

            
            if ($this->brandModel->update($id, $dataToEdit)) {
                $session = session();
                $session->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(AD . "brtable?user_id=".$user_id);
            }
        }
          
        }
        $data["brand"]=$this->brandModel->find($id);
        $data["errors"]=$this->brandModel->errors();
    
          
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
         $data['title'] = "All Brand | Admin ";
         $data['page_name'] = "Brand ";
        $data['brand'] =$this->brandModel->findAll();  
          
        return view("admin/allbrand_table",$data);  
      }    
    
}
