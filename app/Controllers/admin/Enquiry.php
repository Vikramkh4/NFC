<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BrandModel;
use App\Models\EnquiryModel;

class Enquiry extends BaseController
{
    public $Brand;
    public $enquiry;
    
    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }

        $this->Brand = new BrandModel();
        $this->enquiry = new EnquiryModel();
    }

    public function index()
    {
        $data['title'] = "Admin | Enquiry Form";
        $data['page'] = AD. 'enquiry_form'; // Adjust this to your view's path if needed
        $data['page_name'] = "Enquiry Form";

        return view($data['page'], $data);
    }
    public function submit()
    {
        $model = new EnquiryModel();
        $validation = \Config\Services::validation();
    
        if ($this->request->getMethod() == 'POST') {
            $brand_id = $this->request->getPost("brand_id");
    
            // Define validation rules
            $rules = [
                'email'    => 'required|valid_email',
                'name'     => 'required|min_length[3]',
                'topic'    => 'required|min_length[3]',
                'comment'  => 'required|min_length[10]',
            ];

    
            // Validate input data
            if (!$this->validate($rules)) {
                $data['title'] = "Admin | Enquiry Form";
                $data['page'] = ADMIN . "enquiry_form";
                $data['page_name'] = "Enquiry Form";
                $data['errors'] = $validation->getErrors();
                return view($data['page'], $data);
            }
    
            // Prepare data for saving
            $dataToAdd = [
                'email'   => $this->request->getPost('email'),
                'name'    => $this->request->getPost('name'),
                'topic'   => $this->request->getPost('topic'),
                'comment' => $this->request->getPost('comment'),
                'brand_id' => $brand_id,
            ];
    
            // Save data to the database
            if ($model->save($dataToAdd)) {
                session()->setFlashdata('success', 'Enquiry submitted successfully.');
                return redirect()->to(AD . '/enquiryview?brand_id=' . $brand_id);
            } else {
                $data['errors'] = $model->errors();
                $data['title'] = "Admin | Enquiry Form";
                $data['page'] = ADMIN . "enquiry_form";
                $data['page_name'] = "Enquiry Form";
                return view($data['page'], $data);
            }
        } else {
            $data['title'] = "Admin | Enquiry Form";
            $data['page'] = ADMIN . "enquiry_form";
            $data['page_name'] = "Enquiry Form";
            return view($data['page'], $data);
        }
    }
    
    public function view()
    {
        $brand_id = $this->request->getGet('brand_id');
        $data['title'] = "Admin | Enquiries";
        $data['page'] = AD . 'enquiry_list'; // View file for listing enquiries
        $data['page_name'] = "Enquiries";

        if ($brand_id) {
            $data['enquiries'] = $this->enquiry->where('brand_id', $brand_id)->findAll();
        } else {
            $data['enquiries'] = $this->enquiry->findAll();
        }

        return view($data['page'], $data);
    }
    public function show($id)
    {
        $model = new EnquiryModel();
        $data['enquiry'] = $model->find($id);
        if (!$data['enquiry']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Enquiry with ID $id not found");
        }

        $data['title'] = "Enquiry Details";
        $data['page'] = AD. 'enquiry_details'; // View file for enquiry details
        $data['page_name'] = "Enquiry Details";

        return view($data['page'], $data);
    }
    public function updateStatus($id)
    {
        $brand_id = $this->request->getGet('brand_id');
        $model = new EnquiryModel();

        // Validate the status input
        $status = $this->request->getPost('status');

        if (!$status) {
            session()->setFlashdata('error', 'Status cannot be empty.');
            return redirect()->back()->withInput();
        }
        $status = $this->request->getPost('status');

        // Update the status to "Solved" in the database
        $model->update($id, ['status' => $status]);

        session()->setFlashdata('success', 'Status updated to Solved successfully.');
        return redirect()->to(AD . '/enquiryview?brand_id=' . $brand_id);
    }
    public function delete($id = null)
{
    $model = new EnquiryModel();

    if ($id && $model->delete($id)) {
        $data = [
            'status' => 'success',
            'status_text' => 'Enquiry has been deleted successfully',
            'status_icon' => 'success'
        ];
        session()->setFlashdata('success', 'Enquiry deleted successfully');
    } else {
        $data = [
            'status' => 'error',
            'status_text' => 'Failed to delete enquiry',
            'status_icon' => 'error'
        ];
        session()->setFlashdata('error', 'Failed to delete enquiry');
    }

    return $this->response->setJSON($data);
}

}
