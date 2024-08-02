<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;


use App\Models\AmenitiesModel;

class Amenities extends BaseController
{
    public $amenitiesModel;
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
       $this->amenitiesModel = new AmenitiesModel();

    }
    public function index()
    {
        $data['title'] = "Admin | Dashboard";
    $data['page'] = ADMIN."add_amenities";
    $data['page_name'] = "Add Amenities";
    
        // Load the view to display the form
        return view( $data['page'],$data);
    }
    public function store_amenities(){
     
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'icon' => 'required|min_length[3]|max_length[255]',
        ];

        if (!$this->validate($rules)) {
            return view('admin/add_amenities', [
                'validation' => $this->validator,
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'icon' => $this->request->getPost('icon'),
        ];

        $this->amenitiesModel->save($data);
        return redirect()->to('admin/amenities')->with('success', 'Amenity added successfully');
    }

    public function show(){
        $data['title'] = "Admin | Dashboard";
        $data['page'] = ADMIN."amenities_table";
        $data['page_name'] = "Amenities Table";
        $data['amenities'] = $this->amenitiesModel->findAll();
        return view( $data['page'],$data);
    }

    public function edit($id)
{
    $amenity = $this->amenitiesModel->find($id);

    if (!$amenity) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Amenity not found');
    }

    $data = [
        'title' => 'Edit Amenity',
        'page' => ADMIN . 'edit_amenities',
        'page_name' => 'Edit Amenity',
        'amenity' => $amenity,
        'validation' => $this->validator,
    ];

    return view($data['page'], $data);
}
public function update($id)
{
    $rules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'icon' => 'required|min_length[3]|max_length[255]',
    ];

    if (!$this->validate($rules)) {
        return view('admin/edit_amenity', [
            'validation' => $this->validator,
            'amenity' => $this->amenitiesModel->find($id),
            'page_name' => 'Edit Amenity'
        ]);
    }

    $data = [
        'name' => $this->request->getPost('name'),
        'icon' => $this->request->getPost('icon'),
    ];

    $this->amenitiesModel->update($id, $data);

    return redirect()->to('admin/amenity_table')->with('success', 'Amenity updated successfully');
}
public function delete($id)
{
    $amenity = $this->amenitiesModel->find($id);

    if (!$amenity) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Amenity not found');
    }

    $this->amenitiesModel->delete($id);

    return redirect()->to('admin/amenity_table')->with('success', 'Amenity deleted successfully');
}

}