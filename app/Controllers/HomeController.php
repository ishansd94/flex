<?php

namespace App\Controllers;


use App\Framework\Core\Controller;
use App\Framework\Helpers\Cookie;
use App\Framework\Helpers\Hash;
use App\Framework\Helpers\Password;
use App\Framework\Helpers\Redirect;
use App\Framework\Helpers\Session;
use App\Framework\Helpers\Token;
use App\User;

class HomeController extends Controller
{
    public function index(){

    		var_dump(Session::all());

    		var_dump(Session::exists("_flash.msg"));

            //Session::flash("msg" , "this is a flash msg");
            

            

            //Session::set("_flash.msg", "something");
            //Session::delete("_flash.msg");

            

            echo Session::flash("msg"));

            var_dump(Session::all());

    }

}