<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

           
            $setRules = ([
                'email' => [
                    'label'  => 'Rules.username',
                    'rules'  => 'required|min_length[6]|max_length[50]|valid_email',
                    'errors' => [
                        'required' => 'Email is required',
                    ],
                ],
                'password' => [
                    'label'  => 'Rules.password',
                    'rules'  => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
                    'errors' => [
                        'validateUser' => 'Email or Password didn match',
                    ],
                ],
            ]);

            
            $data = [
                "email"=>$this->request->getPost("email"),
                "password"=>$this->request->getPost("password")
            ];
            
              if (! $this->validateData($data, $setRules)) {
                    return redirect()->back()->withInput();
                }
               else {
                $model = new UserModel();

                $user = $model->where('email', $this->request->getPost('email'))
                    ->first();
       
                // Strong session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if($user['role'] == "admin"){
            
                    return redirect()->to(base_url('admin'));

                }elseif($user['role'] == "primary"){

                    return redirect()->to(base_url('primary'));
                }
                else if($user['role'] == "user"){
                    return redirect()->to(base_url('user'));
                }
            }
        }
        return view('signin');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['user_id'],
            'name' => $user['name'],
            'phone_no' => $user['phone_no'],
            'email' => $user['email'],
            'isLoggedIn' => true,
            "role" => $user['role'],
            "user_id"=>$user['user_id']
           
           
        ];

        session()->set($data);
        return true;
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


    public function registration_page()
    {
        return view("signup");
    }


    public function saving_registration(){
        $rules = [
            'name' => 'required|min_length[4]',
            'password' => 'required|min_length[8]',
            'email'    => 'required|valid_email|is_unique[_users_.email,ignore_value]',
            'phone_no' => 'required'
    ];
        
       if(!$this->validate($rules)){
         $data['validation'] = $this->validator->getErrors();  
        return view("signup",$data);
       }else{
          $save  = new UserModel();
          $data = [
            'name' => $this->request->getPost("name"),
            'password' => $this->request->getPost("password"),
            'email'=>$this->request->getPost("email"),
            'role'=>"user",
            'phone_no'=>$this->request->getPost("phone_no")
          ];

         $save->insert($data);

         return redirect("/");

       }
      

    }




    public function globle_error(){
        session()->setFlashdata("error","Something went worng");
        return view('error');
    }

}