<?php
namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\BrandModel;
use App\Models\Brand_service;
class Services extends BaseController
{
  public $serviceModel;
  public $Brand_service;
  public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->serviceModel = new ServiceModel();
      $this->Brand_service = new Brand_service();
    

  }
public function addservice()
{
    $data['title'] = "Admin | Services";
    $data['page_name'] = "Services";
    if ($this->request->getMethod() == 'POST') {
        $brand_id = $this->request->getPost("brand_id");
        $newName = "";
        $logoFile = $this->request->getFile('image');
        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(IMAGE_PATH, $newName);
        }
        $dataToAdd = [
            'brand_id' => $brand_id,
            'image' => $newName,
            'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
        ];
        if ($this->serviceModel->insert($dataToAdd)) {
            $service_id = $this->serviceModel->insertID(); // Get the ID of the inserted service
            $brand2 = [
                'brand_id' => $brand_id,
                'service_id' => $service_id,
            ];
            if ($this->Brand_service->insert($brand2)) {
                session()->setFlashdata('success', 'Services successfully added');
                return redirect()->to(AD ."srtable?brand_id=".$brand_id);

            } else {
                $data['errors'] = $this->Brand_service->errors();
            }
        } else {
            $data['errors'] = $this->serviceModel->errors();
        }
    }
    $data['page'] = ADMIN . "services_add";
    return view($data['page'], $data);
}

public function viewServices()
{   $data['title'] = "Admin | Services";
    $data['page'] = ADMIN."services_table";
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
        $data['title'] = "Admin | Edit Services";
        $data['page'] = ADMIN . "services_edit";
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
                return redirect()->to(AD ."srtable?brand_id=".$brand_id);
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

    public function get_allService(){
         $data['title'] = "All Services | Admin ";
         $data['page_name'] = "Services ";
        $data['services'] =$this->serviceModel->findAll();  
          
        return view("admin/allservice_table",$data);  
      }    
        
    
    
    
}