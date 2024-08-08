<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\MarketModel;

class Market extends BaseController
{
    protected $marketModel;

    public function __construct()
    {
        // Check if user is an admin
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
        
        // Load the MarketModel
        $this->marketModel = new MarketModel();
    }
 public function viewtable()
    {
        $data['title'] = "Admin | Market";
        $data['page'] = ADMIN . "markettable";
        $data['page_name'] = "Market Table";
        
        // Fetch all market entries
        $data['markets'] = $this->marketModel->findAll();

        // Check if the request method is 'post'
        if ($this->request->getMethod() == 'post') {
            // Handle POST request logic here if needed
        } else {
            $data['page'] = ADMIN . "markettable";
            return view($data['page'], $data);
        }
    }
    
    public function add_market()
    {
        $data['title'] = "Admin | Market";
        $data['page_name'] = "Market Add";
        $data['page'] = ADMIN . "add_market";

        // Display the form
        return view($data['page'], $data);
    }
    
    public function store_market(){
        $this->marketModel = new MarketModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
            'local_area' => $this->request->getPost('local_area'),
        ];
        // Handle file upload
        if ($this->request->getFile('icon')->isValid()) {
            $file = $this->request->getFile('icon');
            $newName = $file->getRandomName();
            $file->move('uploads/market_image', $newName);
            $data['icon'] = $newName;
        }
        $this->marketModel->insert($data);

        return redirect()->to(base_url('admin/add_market'));
    }
    public function delete_market($id)
    {
        $market = $this->marketModel->find($id);
    
        if ($market) {
            // Check if the 'icon' field is set and if the file exists
            if (!empty($market['icon']) && file_exists('uploads/market_image/' . $market['icon'])) {
                // Ensure it's a file before attempting to delete
                if (is_file('uploads/market_image/' . $market['icon'])) {
                    unlink('uploads/market_image/' . $market['icon']);
                }
            }
    
            // Delete the market entry
            $this->marketModel->delete($id);
            session()->setFlashdata('success', 'Market successfully deleted');
        } else {
            session()->setFlashdata('error', 'Market not found');
        }
    
        return redirect()->to(base_url('admin/viewtable'));
    }
    

    public function edit_market($id)
    {
        $data['title'] = "Admin | Edit Market";
        $data['page_name'] = "Edit Market";
        $data['page'] = ADMIN . "edit_market";

        // Fetch market entry by ID
        $data['market'] = $this->marketModel->find($id);

        if (!$data['market']) {
            session()->setFlashdata('error', 'Market not found');
            return redirect()->to(base_url('admin/viewtable'));
        }

        return view($data['page'], $data);
    }

    public function update_market($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'details' => $this->request->getPost('details'),
            'local_area' => $this->request->getPost('local_area'),
        ];

        // Handle file upload
        if ($this->request->getFile('icon')->isValid()) {
            $file = $this->request->getFile('icon');
            $newName = $file->getRandomName();
            $file->move('uploads/market_image', $newName);

            // Delete the old icon if a new one is uploaded
            $market = $this->marketModel->find($id);
            if (file_exists('uploads/market_image/' . $market['icon'])) {
                unlink('uploads/market_image/' . $market['icon']);
            }

            $data['icon'] = $newName;
        }

        $this->marketModel->update($id, $data);

        return redirect()->to(base_url('admin/viewtable'));
    }
 
    
    

}