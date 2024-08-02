<?php

namespace App\Controllers\admin;

use App\Models\BannerModel;
use App\Controllers\BaseController;

class Banner extends BaseController
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function index()
    {
        $data['title'] = "Admin | Dashboard";
        $data['page'] = "admin/add_banner";
        $data['page_name'] = "Add Banner";
    
        return view($data['page'], $data);
    }

    public function store_banner()
{   
    $data['title'] = "Admin | Add Banner";
    
    if ($this->request->getMethod() === 'POST') {
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'uploaded[icon]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/gif,image/png]|max_size[icon,2048]'
        ]);

        if ($validated) {
            $file = $this->request->getFile('icon');
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('./uploads/banner_image', $fileName);

                $newData = [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'image' => $fileName
                ];

                if ($this->bannerModel->save($newData)) {
                    return redirect()->to('admin/banner_table')->with('success', 'Banner stored successfully');
                } else {
                    return redirect()->back()->with('error', 'Failed to store banner');
                }
            } else {
                return redirect()->back()->with('error', 'File upload failed');
            }
        } else {
            return redirect()->back()->with('error', 'Validation failed');
        }
    }

    return redirect()->to('admin/banner_table')->with('success', 'Banner added successfully');
}



    public function show()
    {
        $data['title'] = "Admin | Banner Table";
        $data['page'] = ADMIN."banner_table";
        $data['page_name'] = "Banners";
        $data['banners'] = $this->bannerModel->findAll();
        
        return view('admin/banner_table', $data);
    }

    public function edit($id)
{
    $data['title'] = "Admin | Edit Banner";
    $data['banners'] = $this->bannerModel->find($id);

    if ($this->request->getMethod() === 'POST') {
        $validated = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'if_exist|uploaded[icon]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/gif,image/png]|max_size[icon,2048]'
        ]);

        if ($validated) {
            $newData = [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ];

            // Handle image upload if a new image is uploaded
            $image = $this->request->getFile('icon');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $newImageName = $image->getRandomName();
                $image->move('./uploads/banner_image', $newImageName);

                // Delete the old image if it exists
                if (!empty($data['banners']['image']) && file_exists('./uploads/banner_image/' . $data['banners']['image'])) {
                    unlink('./uploads/banner_image/' . $data['banners']['image']);
                }

                // Update the new image name in the data array
                $newData['image'] = $newImageName;
            }

            if ($this->bannerModel->update($id, $newData)) {
                return redirect()->to('admin/banner_table')->with('success', 'Banner updated successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to update banner');
            }
        } else {
            return redirect()->back()->with('error', 'Validation failed');
        }
    }

    return view('admin/edit_banner', $data);
}

    

    public function delete($id)
    {
        if ($this->bannerModel->delete($id)) {
            return redirect()->to('admin/banner_table')->with('success', 'Banner deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete banner');
        }
    }
}