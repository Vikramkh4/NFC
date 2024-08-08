<?php
namespace App\Controllers\hki;

use App\Controllers\BaseController;

use App\Models\ServiceModel;
use App\Models\BrandModel;
class Services extends BaseController
{
  public $serviceModel;
  public function __construct()
  {
       if (session()->get('role') !== "vendor") {
            echo 'Access denied';
            exit;
        }
      $this->serviceModel = new ServiceModel();
    

  }
  public function addservice()
{


    $data['title'] = "vendor | Services";
    $data['page_name'] = "Services ";
  
    if ($this->request->getMethod() == 'POST') {
        $logoFile = $this->request->getFile('image');
        $brand_id = $this->request->getGetPost("brand_id");
     

        $newName = $logoFile->getRandomName();
        
        $logoFile->move('./uploads/Services', $newName);
        
        $dataToAdd = [
            'brand_id'=>$brand_id,
            'image' => $newName, 
            'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
            
            
        ];

        if ($this->serviceModel->save($dataToAdd)) {                
            session()->setFlashdata('success', 'Services successfully added');
            return redirect()->to(VD ."srtable2?brand_id=".$brand_id);
        } else {
            $data['errors'] = $this->serviceModel->errors();
            $data['page'] = VENDOR . "services_add";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = VENDOR . "services_add";
        return view($data['page'], $data);
    }
}
public function viewServices()
{   $data['title'] = "vendor | Services";
    $data['page'] = VENDOR."services_table";
    $data['page_name'] = "services ";
    $brand_id = $this->request->getGetPost("brand_id");
    $bra = new BrandModel();
    $list  = $bra->find($brand_id);
     if(isset($list) && !empty($list)){
        $data['services']=$this->serviceModel->where("brand_id",$brand_id)->find();
        }else{
         return view($data['page'],$data);
        }
  return view($data['page'],$data);
}

public function editServices($id = null)
    {
        $data['title'] = "vendor | Edit Services";
        $data['page'] = VENDOR . "services_edit";
        $data['page_name'] = " Services";

        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('image');
            $brand_id = $this->request->getGetPost("brand_id");
            if($logoFile->getSize()  != 0 && !empty($logoFile->getSize()) ){

               
                $newName = $logoFile->getRandomName(); 
                $logoFile->move('./uploads/Services', $newName);
           

            $dataToEdit = [
                'brand_id'=>$brand_id,
                'image' => $newName, 
            'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
                
            ];
        }
        else{
            $dataToEdit = [
                'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
               
            ];  

        
        }


            if ($this->serviceModel->update($id, $dataToEdit)) {
                $session = session();
                $session->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(VD ."srtable2?brand_id=".$brand_id);
            } else {
                $session = session();
                $session->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            }


        } 
        
        else {
            $data["services"] = $this->serviceModel->find($id);
            $data["errors"] = $this->serviceModel->errors();
            return view($data['page'], $data);
        }
    }
    public function deleteServices($id = null)
    {
        if ($id && $this->serviceModel->delete($id)) {
            $data = [
                'status' => 'success',
                'status_text' => 'Service has been deleted successfully',
                'status_icon' => 'success'
            ];
            session()->setFlashdata('success', 'Service deleted successfully');
        } else {
            $data = [
                'status' => 'error',
                'status_text' => 'Failed to delete service',
                'status_icon' => 'error'
            ];
            session()->setFlashdata('error', 'Failed to delete service');
        }
    
        return $this->response->setJSON($data);
    }
     

      public function get_allservice()
{
    $data['title'] = "All Product | vendor";
    $data['page_name'] = "Product";
    
    // Assuming the user_id is stored in the session
    $user_id = session()->get('user_id');
    
    // Fetch products associated with the user_id by joining the brands table
    $data['services'] = $this->serviceModel
        ->select('services.*, brand.u_id')
        ->join('brand', 'brand.id = services.brand_id')
        ->where('brand.u_id', $user_id)
        ->findAll();
    
    return view("vendor/allservices", $data);
}
        
    
    
    
}