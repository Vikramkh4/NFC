<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function __construct() {
        helper('custom');
    }

    // protected $categoryModel;
    public function index()
    {
        $data['title'] = "Admin | Categories";
        $data['page_name'] = ADMIN."category";
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        
        return view( $data['page_name'] , $data);
    }
  public function add()
  {
      $data['title'] = "Admin | Dashboard";
      $data['page'] = ADMIN . "addcategory";
      $data['page_name'] = "Dashboard";
      
      $categoryModel = new CategoryModel();
      $categories = $categoryModel->where('parent', 0)->findAll();
  
      $data['categories'] = $categories;
  
      return view($data['page'], $data);
  }
  

    public function save()
    {   
        helper(['form', 'url']);
        $categoryModel = new CategoryModel();

        $data = [
          'parent' => $this->request->getPost('parent'),
          'name' => $this->request->getPost('name'),
          'slug' => url_title(is_string($this->request->getPost('name')) ? $this->request->getPost('name') : '', '-', true),
          'icon_class' => str_replace(["\n", "\r"], '', $this->request->getPost('icon')),
      ];
      
        // Handle the thumbnail upload
        if ($data['parent'] == 0) {
            $file = $this->request->getFile('thumbnail');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move( './uploads/category', $newName);
                $data['thumbnail'] = $newName;
            } else {
                $data['thumbnail'] = 'thumbnail.png';
            }
        }
        
        $categoryModel->save($data);
        return redirect()->to(ADMIN."categoryview");
    }
    public function update($id)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->find($id);

        if (!$data['category']) {
            return redirect()->to(ADMIN . 'category')->with('error', 'Category not found');
        }

        $data['title'] = "Admin | Edit Category";
        $data['page_name'] = "Edit Category";

        $data['categories'] = $categoryModel->where('parent', 0)->findAll();
        
        return view(ADMIN . 'edit_category', $data);
    }

    public function edit($id)
    {
        helper(['form', 'url']);
        $categoryModel = new CategoryModel();

        $data = [
            'parent' => $this->request->getPost('parent'),
            'name' => $this->request->getPost('name'),
            'slug' => url_title(is_string($this->request->getPost('name')) ? $this->request->getPost('name') : '', '-', true),
            'icon_class' => str_replace(["\n", "\r"], '', $this->request->getPost('icon')),
        ];

        if ($data['parent'] == 0) {
            $file = $this->request->getFile('thumbnail');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('./uploads/category', $newName);
                $data['thumbnail'] = $newName;
            }
        }

        $categoryModel->update($id, $data);
        return redirect()->to(ADMIN . "category")->with('success', 'Category updated successfully');
    }
    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);

        if ($category) {
            $categoryModel->delete($id);
            return redirect()->to(ADMIN . 'categoryview')->with('success', 'Category deleted successfully');
        }

        return redirect()->to(ADMIN . 'category')->with('error', 'Category not found');
    }
}