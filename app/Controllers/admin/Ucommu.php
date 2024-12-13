<?php
namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\SubCommunityModel;
use App\Models\UserComModel;
use App\Models\CommunityModel;
use App\Models\UserModel;

class Ucommu extends BaseController
{
    public $subcommunityModel;
    public $userModel;
    public $userComModel;
    public $communityModel;

    public function __construct()
    {
        if (session()->get('role') != "admin") {
            echo 'Access denied';
            exit;
        }
        $this->subcommunityModel = new SubCommunityModel();
        $this->userModel = new UserModel();
        $this->userComModel = new UserComModel();
        $this->communityModel = new CommunityModel();
    }

    public function table()
    {
        $data['title'] = "Admin | User Community Table";
        $data['page_name'] = "User Community Table";
        $data['data'] = $this->userComModel->findAll();
        $data['page'] = ADMIN . "relation_usc_table"; // Assuming this is the view file name
        return view($data['page'], $data);
    }

    public function view_usercommunity()
    {
        $data['title'] = "Admin | User Community";
        $data['page_name'] = "User Community View";
        $data['users'] = $this->userModel->findAll();
        $data['communities'] = $this->communityModel->findAll();

        if ($this->request->getMethod() == 'POST') {
            $validation = \Config\Services::validation();

            $validationRules = [
                'user_id' => 'required|numeric',
                'community_id' => 'required|numeric'
            ];

            $validationMessages = [
                'user_id' => [
                    'required' => 'User ID is required.'
                ],
                'community_id' => [
                    'numeric' => 'Community ID must be a number.'
                ]
            ];

            $validation->setRules($validationRules, $validationMessages);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $dataToSave = [
                'user_id' => $this->request->getPost('user_id'),
                'community_id' => $this->request->getPost('community_id'),
                'subcom_id' => $this->request->getPost('subcom_id')
            ];

            if ($this->userComModel->insert($dataToSave)) {
                session()->setFlashdata('success', 'Data saved successfully!');
                return redirect()->to(AD . 'communitytable');
            } else {
                $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
                return view($data['page'], $data);
            }
        } else {
            $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
            return view($data['page'], $data);
        }
    }

    public function getSubCommunitiesByCommunityId($community_id)
    {
        if ($this->request->isAJAX()) {
            $subcommunities = $this->subcommunityModel->where('community_id', $community_id)->findAll();
            return $this->response->setJSON($subcommunities);
        }
    }

    public function update_community($id)
    {
        $data['title'] = "Update User Community | User Community";
        $data['user'] = $this->userComModel->find($id);
        $data['page_name'] = "User Community View";
        $data['users'] = $this->userModel->findAll();
        $data['subcommunities'] = $this->subcommunityModel->findAll();
        $data['communities'] = $this->communityModel->findAll();

        if ($this->request->getMethod() == 'POST') {
            $validation = \Config\Services::validation();

            $validationRules = [
                'user_id' => 'required|numeric',
                'community_id' => 'required|numeric'
            ];

            $validationMessages = [
                'user_id' => [
                    'required' => 'User ID is required.'
                ],
                'community_id' => [
                    'numeric' => 'Community ID must be a number.'
                ]
            ];

            $validation->setRules($validationRules, $validationMessages);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

            $dataToUpdate = [
                'user_id' => $this->request->getPost('user_id'),
                'community_id' => $this->request->getPost('community_id'),
                'subcom_id' => $this->request->getPost('subcom_id')
            ];

            if ($this->userComModel->update($id, $dataToUpdate)) {
                session()->setFlashdata('success', 'Data updated successfully!');
                return redirect()->to(AD . 'communitytable');
            } else {
                $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
                return view($data['page'], $data);
            }
        } else {
            $data['page'] = ADMIN . "usercommunity"; // Assuming this is the view file name
            return view($data['page'], $data);
        }
    }
}
?>
