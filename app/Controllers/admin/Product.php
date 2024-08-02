<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\Brand_product;

class Product extends BaseController
{
  public $productModel;
  public function __construct()
  {
      if (session()->get('role') != "admin") {
          echo 'Access denied';
          exit;
      }
      $this->productModel = new ProductModel();
      $this->Brand_product = new Brand_product();
    

  }
  public function addproduct()
{
    $data['title'] = "Admin | Product";
    $data['page_name'] = "Product ";
    
    
  
    if ($this->request->getMethod() == 'POST') {
        $brand_id = $this->request->getGetPost("brand_id");
        
        
       
        $newName = "";
        $logoFile = $this->request->getFile('image');
        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(IMAGE_PATH_PRODUCT, $newName);
        }
        
        
        
        $ruppey = $this->request->getPost('price');
         $newruppey = RP.$ruppey;
        $dataToAdd = [
            'brand_id'=>$brand_id,
            'image' => $newName, 
            'product' => $this->request->getPost('product'),
            'details' => $this->request->getPost('details'),
            'price' =>$newruppey,
            
        ];

        if ($this->Brand_product->brand_product($dataToAdd)) {                
            session()->setFlashdata('success', 'Product successfully added');
            return redirect()->to("admin/prtable?brand_id=$brand_id"); 
        } else {
            $data['errors'] = $this->productModel->errors();
            $data['page'] = ADMIN . "product_add";
            return view($data['page'], $data);
        }
    } else {
        $data['page'] = ADMIN . "product_add";
        return view($data['page'], $data);
    }
}
public function viewProduct()
{   $data['title'] = "Admin | Product";
    $data['page'] = ADMIN."product_table";
    $data['page_name'] = "Product ";
    $brand_id = $this->request->getGetPost("brand_id");
    $bra = new BrandModel();
    $list  = $bra->find($brand_id);
    if(isset($list) && !empty($list)){
    $data['product']=$this->productModel->where("brand_id",$brand_id)->find();
    }else{
     return view($data['page'],$data);
    }
  return view($data['page'],$data);
   
}
public function editProduct($id = null)
    {
        $data['title'] = "Admin | Edit Product";
        $data['page'] = ADMIN . "product_edit";
        $data['page_name'] = " Product";

        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('image');
            $brand_id = $this->request->getGetPost("brand_id");
           
            $ruppey = $this->request->getPost('price');
            $newruppey = RP.$ruppey;
            if($logoFile->getSize()  != 0 && !empty($logoFile->getSize()) ){

            $newName = $logoFile->getRandomName();
            $logoFile->move('./uploads/product', $newName);
           

            $dataToEdit = [
                'brand_id'=>$brand_id,
                'image' => $newName,
                'product' => $this->request->getPost('product'),
                'details' => $this->request->getPost('details'),
                'price' => $newruppey,
            ];
        }
        else{
            $dataToEdit = [
                'product' => $this->request->getPost('product'),
                'details' => $this->request->getPost('details'),
                'price' => $newruppey,
            ];  

        
        }


            if ($this->productModel->update($id, $dataToEdit)) {
                $session = session();
                $session->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(AD . "prtable?brand_id=".$brand_id);
            } else {
                $session = session();
                $session->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            }


        } 
        
        else {
            $data["product"] = $this->productModel->find($id);
            $data["errors"] = $this->productModel->errors();
            return view($data['page'], $data);
        }
    }
    public function deleteproduct($id = null)
    {
        if ($id && $this->productModel->delete($id)) {
            $data = [
                'status' => 'success',
                'status_text' => 'Product has been deleted successfully',
                'status_icon' => 'success'
            ];
            session()->setFlashdata('success', 'Product deleted successfully');
        } else {
            $data = [
                'status' => 'error',
                'status_text' => 'Failed to delete product',
                'status_icon' => 'error'
            ];
            session()->setFlashdata('error', 'Failed to delete product');
        }

        return $this->response->setJSON($data);
    }

    

}