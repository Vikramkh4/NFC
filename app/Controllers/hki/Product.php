<?php

namespace App\Controllers\hki;

use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\Brand_product;

class Product extends BaseController
{
    public $productModel;
    public $Brand_product;

    public function __construct()
    {
        if (session()->get('role') !== "vendor") {
            echo 'Access denied';
            exit;
        }
        $this->productModel = new ProductModel();
        $this->Brand_product = new Brand_product();
    }

    public function addproduct()
    {
        $data['title'] = "vendor | Product";
        $data['page_name'] = "Product ";
           

        if ($this->request->getMethod() == 'POST') {
            $brand_id = $this->request->getPost("brand_id");
            $newName = "";
            $logoFile = $this->request->getFile('image');
            if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                $newName = $logoFile->getRandomName();
                $logoFile->move(IMAGE_PATH_PRODUCT, $newName);
            }

            $ruppey = $this->request->getPost('price');
            $newruppey = RP . $ruppey; // Assuming 'RP' is a currency symbol
            $dataToAdd = [
                'brand_id' => $brand_id,
                'image' => $newName,
                'product' => $this->request->getPost('product'),
                'details' => $this->request->getPost('details'),
                'price' => $newruppey,
            ];

            if ($this->Brand_product->brand_product($dataToAdd)) {
                session()->setFlashdata('success', 'Product successfully added');
                return redirect()->to("hki/prtable2?brand_id=$brand_id");
            } else {
                $data['errors'] = $this->productModel->errors();
                $data['page'] = VENDOR . "product_add";
                return view($data['page'], $data);
            }
        } else {
            $data['page'] = VENDOR . "product_add";
            return view($data['page'], $data);
        }
    }

    public function viewProduct()
    {
        $data['title'] = "vendor | Product";
        $data['page'] = VENDOR . "product_table";
        $data['page_name'] = "Product";
        $brand_id = $this->request->getGet("brand_id"); // Corrected to getGet
        $bra = new BrandModel();
        $list = $bra->find($brand_id);
        if (isset($list) && !empty($list)) {
            $data['product'] = $this->productModel->where("brand_id", $brand_id)->findAll();
        }
        return view($data['page'], $data);
    }

    public function editProduct($id = null)
    {
        $data['title'] = "vendor | Edit Product";
        $data['page'] = VENDOR . "product_edit";
        $data['page_name'] = "Product";

        if ($this->request->getMethod() == 'POST') {
            $logoFile = $this->request->getFile('image');
            $brand_id = $this->request->getPost("brand_id");
            $ruppey = $this->request->getPost('price');
            $newruppey =  RP . $ruppey; // Assuming 'RP' is a currency symbol

            $dataToEdit = [
                'brand_id' => $brand_id,
                'product' => $this->request->getPost('product'),
                'details' => $this->request->getPost('details'),
                'price' => $newruppey
            ];

            if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
                $newName = $logoFile->getRandomName();
                $logoFile->move('./uploads/product', $newName);
                $dataToEdit['image'] = $newName;
            }

            if ($this->productModel->update($id, $dataToEdit)) {
                session()->setFlashdata('success', 'Product updated successfully');
                return redirect()->to(VD . "prtable2?brand_id=$brand_id");
            } else {
                session()->setFlashdata('error', 'Failed to update product');
                return redirect()->back();
            }
        } else {
            $data['product'] = $this->productModel->find($id);
            if (!$data['product']) {
                session()->setFlashdata('error', 'Product not found');
                return redirect()->back();
            }
            $data["errors"] = $this->productModel->errors();
            return view($data['page'], $data);
        }
    }

    public function deleteproduct($id = null)
    {
        if ($id && $this->productModel->delete($id)) {
            session()->setFlashdata('success', 'Product deleted successfully');
            $data = [
                'status' => 'success',
                'status_text' => 'Product has been deleted successfully',
                'status_icon' => 'success'
            ];
        } else {
            session()->setFlashdata('error', 'Failed to delete product');
            $data = [
                'status' => 'error',
                'status_text' => 'Failed to delete product',
                'status_icon' => 'error'
            ];
        }

        return $this->response->setJSON($data);
    }

    public function get_allproduct()
{
    $data['title'] = "All Product | vendor";
    $data['page_name'] = "Product";
    
    // Assuming the user_id is stored in the session
    $user_id = session()->get('user_id');
    
    // Fetch products associated with the user_id by joining the brands table
    $data['product'] = $this->productModel
        ->select('product.*, brand.u_id')
        ->join('brand', 'brand.id = product.brand_id')
        ->where('brand.u_id', $user_id)
        ->findAll();
    
    return view(VENDOR."allproduct", $data);
}

}
