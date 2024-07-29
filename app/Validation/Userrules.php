<?php
namespace App\Validation;

use App\Models\UserModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UserModel();
        $user = $model->where('email', $data['email'])
            ->first();
        
        if (!$user) {
            return false;
        }
        if($user['password']  === $data['password'] && $user['email'] === $data['email']){
          
            return true;
        }
        else{
            return false;
        }
        
    }


   



}