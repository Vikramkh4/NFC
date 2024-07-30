<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UserModel;

class Users extends BaseController
{
  public $empModel;

    public function __construct()
    {
        helper('form');
        
    }
 

}