<?php

namespace App\Controllers;


use App\Framework\Core\Controller;
use App\Framework\Helpers\Cookie;
use App\Framework\Helpers\Session;
use App\Framework\Helpers\Token;
use App\User;

class HomeController extends Controller
{
    public function index(){

            var_dump(Session::info());

    }

}