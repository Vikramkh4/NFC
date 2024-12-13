<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\BrandModel;

class Blog extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
    }

    public function create()
    {
        $brandModel = new BrandModel();
        $data['brand'] = $brandModel->findAll(); // Fetch all brand to populate a dropdown in the view

        $data['title'] = "Admin | Dashboard";
        $data['page'] = ADMIN . "add_blog";
        $data['page_name'] = "Add Review";

        return view($data['page'], $data);
    }

    public function save()
    {
        $blogModel = new BlogModel();
        $rules = [
            'description' => 'required|min_length[3]|max_length[255]',
            'rating' => 'required|integer|greater_than[0]|less_than[6]',
            'brand_id' => 'required|integer|is_not_unique[brand.id]', // Validate against brand table
        ];

        if (!$this->validate($rules)) {
            $brandModel = new BrandModel();
            $data['brand'] = $brandModel->findAll(); // Re-populate the brand dropdown

            $data['title'] = "Admin | Dashboard";
            $data['page'] = ADMIN . "add_blog";
            $data['page_name'] = "Add Review";
            $data['validation'] = $this->validator;
            return view($data['page'], $data);
        }

        $data = [
            'description' => $this->request->getPost('description'),
            'rating' => $this->request->getPost('rating'),
            'brand_id' => $this->request->getPost('brand_id'), // Fetch the brand_id from the form
        ];

        // Handle file upload
        $file = $this->request->getFile('blog_image');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/blog_image/', $newName);
            $data['blog_image'] = $newName;
        }

        $blogModel->insert($data);

        return redirect()->to(base_url('admin/blog_list'));
    }

    public function index()
    {
        $blogModel = new BlogModel();
        $data['blogs'] = $blogModel->findAll();
        $data['title'] = "Admin | Blog List";
        $data['page'] = ADMIN . "blog_table";
        $data['page_name'] = "Review List";

        return view($data['page'], $data);
    }

    public function delete($id)
    {
        $blogModel = new BlogModel();
        $blog = $blogModel->find($id);

        if ($blog) {
            // Remove the file from the server
            if (!empty($blog['blog_image'])) {
                $filePath = 'uploads/blog_image/' . $blog['blog_image'];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }

            $blogModel->delete($id);
            return redirect()->to(base_url('admin/blog_list'));
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog not found');
        }
    }

    public function edit($id)
    {
        $blogModel = new BlogModel();
        $brandModel = new BrandModel();
        $data['blog'] = $blogModel->find($id);
        $data['brand'] = $brandModel->findAll(); // Fetch all brand to populate a dropdown in the edit view

        if (!$data['blog']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog not found');
        }

        $data['title'] = "Admin | Edit Blog";
        $data['page'] = ADMIN . "edit_blog";
        $data['page_name'] = "Edit Review";

        return view($data['page'], $data);
    }

    public function update($id)
    {
        $blogModel = new BlogModel();
        $rules = [
            'description' => 'required|min_length[3]|max_length[255]',
            'rating' => 'required|integer|greater_than[0]|less_than[6]',
            'brand_id' => 'required|integer|is_not_unique[brand.id]', // Validate against brand table
        ];

        if (!$this->validate($rules)) {
            $brandModel = new BrandModel();
            $data['brand'] = $brandModel->findAll(); // Re-populate the brand dropdown

            $data['title'] = "Admin | Edit Blog";
            $data['page'] = ADMIN . "edit_blog";
            $data['page_name'] = "Edit Review";
            $data['validation'] = $this->validator;
            $data['blog'] = $blogModel->find($id);
            return view($data['page'], $data);
        }

        $data = [
            'description' => $this->request->getPost('description'),
            'rating' => $this->request->getPost('rating'),
            'brand_id' => $this->request->getPost('brand_id'), // Fetch the brand_id from the form
        ];

        // Handle file upload if there's a new image
        $file = $this->request->getFile('blog_image');
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/blog_image/', $newName);
            $data['blog_image'] = $newName;
        }

        $blogModel->update($id, $data);

        return redirect()->to(base_url('admin/blog_list'));
    }

    public function viewreview($id)
    {
        $data['title'] = "Admin | Dashboard";

        $blogModel = new BlogModel();
        $data['review'] = $blogModel->find($id); // Fetch the specific blog by ID
        $data['page_name'] = 'View Review';

        return view('admin/viewreview', $data);
    }
}
