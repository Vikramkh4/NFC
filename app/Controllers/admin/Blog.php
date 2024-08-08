<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;

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
        $data['title'] = "Admin | Dashboard";
        $data['page'] = ADMIN . "add_blog";
        $data['page_name'] = "Add Review";

        // Load the view to display the form
        return view($data['page'], $data);
    }

    public function save()
    {
        $blogModel = new BlogModel();
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return view('admin/add_blog', [
                'validation' => $this->validator,
            ]);
        }
        
        $data =[
            'tittle' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        // Handle file upload
        if ($this->request->getFile('blog_image')->isValid()) {
            $file = $this->request->getFile('blog_image');
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
            if (isset($blog['blog_image'])) {
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
        $data['blog'] = $blogModel->find($id);

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
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return view('admin/edit_blog', [
                'validation' => $this->validator,
                'blog' => $this->request->getPost(),
            ]);
        }

        $data = [
            'tittle' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ];

        // Handle file upload if there's a new image
        if ($this->request->getFile('blog_image')->isValid()) {
            $file = $this->request->getFile('blog_image');
            $newName = $file->getRandomName();
            $file->move( 'uploads/blog_image/', $newName);
            $data['blog_image'] = $newName;
        }

        $blogModel->update($id, $data);

        return redirect()->to(base_url('admin/blog_list'));
    }
}
