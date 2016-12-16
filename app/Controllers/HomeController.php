<?php
/**
 * Created by PhpStorm.
 * User: ishan
 * Date: 15/12/2016
 * Time: 8:46 PM
 */

namespace App\Controllers;


use App\Framework\Core\Controller;
use App\Framework\Helpers\Cookie;
use App\Framework\Helpers\Session;
use App\User;

class HomeController extends Controller
{
    public function index(){

        var_dump(Session::info());



    }

}