<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use App\Models\ServiceModel;
use App\Models\CommunityModel;
use App\Models\CategoryModel;

class Admin extends BaseController
{   
    protected $empModel;
    protected $brand;
    protected $productModel;
    protected $serviceModel;
    protected $categoryModel;
    protected $communityModel;

    public function __construct()
    {
        // Check if the user is an admin
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }

        // Initialize models
        $this->empModel = new UserModel();
        $this->brand = new BrandModel();
        $this->productModel = new ProductModel();
        $this->serviceModel = new ServiceModel();
        $this->categoryModel = new CategoryModel();
        $this->communityModel = new CommunityModel();
    }

    public function index()
    {
        $data = [
            'title' => "Admin | Dashboard",
            'page' => ADMIN . "index",
            'page_name' => "Dashboard",
            'users' => $this->empModel->builder()->countAll(),
           'primary' => $this->empModel->builder()->where("role","vendor")->countAllResults(),
            'brands' => $this->brand->builder()->countAll(),
            'product' => $this->productModel->builder()->countAll(),
            'service' => $this->serviceModel->builder()->countAll(),
        ];

        return view($data['page'], $data);
    }

    public function viewEmp()
    {
        $data = [
            'title' => "Admin | Dashboard",
            'page' => ADMIN . "usertable",
            'page_name' => "User",
            'users' => $this->empModel->whereIn('role', ["user", "vendor"])->findAll(),
            'communities' => $this->communityModel->findAll(),
        ];

        return view($data['page'], $data);
    }

    public function adduser()
    {
        $data = [
            'title' => "Admin | User",
            'page' => ADMIN . "adduser",
            'page_name' => "User",
        ];

        if ($this->request->getMethod() == 'POST') {
            $image = $this->request->getFile('image');

            $rules = [
                'name' => 'required|min_length[4]',
                'email' => 'required|valid_email|is_unique[_users_.email]',
                'phone_no' => 'required',
                'password' => 'required|min_length[8]',
                'role' => 'required',
                'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,2048]'
            ];

            if (!$this->validate($rules)) {
                $data['errors'] = $this->validator->getErrors();
                return view($data['page'], $data);
            }

            $imageName = null;
            if ($image->isValid() && !$image->hasMoved()) {
                $imageName = $image->getRandomName();
                $image->move('./uploads', $imageName);
            }

            $dataToAdd = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone_no' => $this->request->getPost('phone_no'),
                'password' => $this->request->getPost('password'),
                'role' => $this->request->getPost('role'),
                'image' => $imageName,
            ];

            if ($this->empModel->save($dataToAdd)) {
                session()->setFlashdata('success', 'User successfully added');
                return redirect()->to(AD . 'user');
            } else {
                $data['errors'] = $this->empModel->errors();
                return view($data['page'], $data);
            }
        }

        return view($data['page'], $data);
    }

    public function edituser($id = null)
    {
        $data = [
            'title' => "Admin | User",
            'page' => ADMIN . "edituser",
            'page_name' => "User",
        ];

        if ($this->request->getMethod() == 'POST') {
            $currentUser = $this->empModel->find($id);

            if (!$currentUser) {
                session()->setFlashdata('error', 'User not found');
                return redirect()->to(AD . 'user');
            }

            $dataToUpdate = [
                'name' => $this->request->getPost('name', FILTER_SANITIZE_STRING),
                'email' => $this->request->getPost('email', FILTER_SANITIZE_EMAIL),
                'phone_no' => $this->request->getPost('phone_no', FILTER_SANITIZE_STRING),
                'role' => $this->request->getPost('role', FILTER_SANITIZE_STRING),
            ];

            if ($password = $this->request->getPost('password')) {
                $dataToUpdate['password'] = $password;
            }

            $image = $this->request->getFile('image');
            if ($image->isValid() && !$image->hasMoved()) {
                if ($currentUser['image'] && file_exists('./uploads/' . $currentUser['image'])) {
                    unlink('./uploads/' . $currentUser['image']);
                }

                $imageName = $image->getRandomName();
                $image->move('./uploads', $imageName);
                $dataToUpdate['image'] = $imageName;
            } else {
                $dataToUpdate['image'] = $currentUser['image'];
            }

            if ($this->empModel->update($id, $dataToUpdate)) {
                session()->setFlashdata('success', 'Updated Successfully');
                return redirect()->to(AD . 'user');
            } else {
                session()->setFlashdata('error', 'Update Failed');
                return redirect()->to(current_url());
            }
        }

        $data['emp'] = $this->empModel->find($id);
        $data['errors'] = $this->empModel->errors();

        return view($data['page'], $data);
    }

    public function deleteuser($id = null)
    {
        if ($id && $this->empModel->delete($id)) {
            session()->setFlashdata('success', 'Employee deleted successfully');
        } else {
            session()->setFlashdata('error', 'Failed to delete employee');
        }

        return redirect()->to(base_url() . '/admin/user');
    }

    public function viewuser($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $user = $this->empModel->find($id);

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
        }

        $brands = $this->brand->where('u_id', $id)->findAll();
        $brandIds = $brands ? array_column($brands, 'id') : [];
        $products = !empty($brandIds) ? $this->productModel->whereIn('brand_id', $brandIds)->findAll() : [];
        $services = !empty($brandIds) ? $this->serviceModel->whereIn('brand_id', $brandIds)->findAll() : [];

        $data = [
            'emp' => $user,
            'brands' => $brands,
            'products' => $products,
            'services' => $services,
            'page' => ADMIN . 'viewuser',
            'title' => "Admin | View",
        ];

        return view($data['page'], $data);
    }
}
