<?php

namespace App\Controllers;

class User extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "user") {
            echo 'Access denied';
            exit;
        }
    }

    public function index(){

         return view ('theme/layout/base');
    }

}