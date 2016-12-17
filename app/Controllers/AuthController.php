<?php

namespace App\Controllers;

use App\Framework\Core\Controller;
use App\Framework\Helpers\Session;
use App\User;

class AuthController extends Controller{

    public function login($param1="" , $param2 = ""){

       $users = User::all()->toArray();


       return view("auth.index" , compact('users'));

    }

}