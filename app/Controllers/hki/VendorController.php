<?php

namespace App\Controllers\hki;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;

class VendorController extends BaseController
{
    protected $empModel;
    protected $brandModel;
    protected $productModel;
    protected $serviceModel;

    public function __construct() 
    {
        // Check if the user is logged in and has the vendor role
        if (session()->get('role') !== "vendor") {
            echo 'Access denied';
        }

        // Initialize models
        $this->empModel = new UserModel();
        $this->brandModel = new BrandModel();
        $this->productModel = new ProductModel();
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {   
        $data['title'] = "Vendor | Dashboard";
        $data['page'] = VENDOR."index"; 
        $data['page_name'] = "Dashboard";

        // Get total counts
        $data['users1'] = $this->empModel->countAll();
        $data['brands'] = $this->brandModel->countAll();
        $data['product'] = $this->productModel->countAll();
        $data['service'] = $this->serviceModel->countAll();

        // Get the ID of the logged-in user
        $user_id = session()->get('user_id');

        if ($user_id) {
            $user = $this->empModel->find($user_id);
            if ($user && isset($user['brand_id'])) {
                $brand_id = $user['brand_id'];
                $brand = $this->brandModel->find($brand_id);
                if ($brand) {
                    $data['brand_products'] = $this->productModel->where('brand_id', $brand_id)->countAll();
                    $data['brand_services'] = $this->serviceModel->where('brand_id', $brand_id)->countAll();
                    $data['user_brand'] = $brand;
                }
            }
        }

        return view($data['page'], $data);
    }

    public function viewEmp()
    {
        $data['title'] = "Vendor | Users";
        $data['page'] = VENDOR.'usertable'; // Ensure this path is correct
        $data['page_name'] = "Users";

        return view($data['page'], $data);
    }

   /* public function addUser()
    {
        $data['title'] = "Vendor | Add User";
        $data['page'] = VENDOR.'adduser'; // Ensure this path is correct
        $data['page_name'] = "Add User";

        if ($this->request->getMethod() == 'post') {
            $dataToAdd = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('phone_no'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role')
            ];

            if ($this->empModel->save($dataToAdd)) {
                session()->setFlashdata('success', 'User successfully added');
                return redirect()->to('/VENDOR.user'); // Adjust URL as necessary
            } else {
                $data['errors'] = $this->empModel->errors();
                return view($data['page'], $data);
            }
        } else {
            return view($data['page'], $data);
        }
    }

    public function editUser($id = null)
    {
        $data['title'] = "Vendor | Edit User";
        $data['page'] = VENDOR.'edituser'; // Ensure this path is correct
        $data['page_name'] = "Edit User";

        if ($this->request->getMethod() == 'post') {
            $dataToUpdate = [
                'name' => $this->request->getPost('name', FILTER_SANITIZE_STRING),
                'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
                'phone_no' => $this->request->getPost('phone_no', FILTER_SANITIZE_STRING),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role', FILTER_SANITIZE_STRING)
            ];

            if ($this->empModel->update($id, $dataToUpdate)) {
                session()->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(current_url());
            } else {
                session()->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            }
        }

        $data["emp"] = $this->empModel->find($id);
        $data["errors"] = $this->empModel->errors();

        return view($data['page'], $data);
    }

    public function deleteUser($id = null)
    {
        if ($id && $this->empModel->delete($id)) {
            session()->setFlashdata('success', 'Employee deleted successfully');
        } else {
            session()->setFlashdata('error', 'Failed to delete employee');
        }

        return redirect()->to('/VENDOR.user'); // Adjust URL as necessary
    }
*/
}
