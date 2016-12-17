<?php

namespace App\Framework\Helpers;


class Token
{
    public static function generate(){

        $token = Hash::generate(32);

        Session::set(TOKEN_NAME , $token);

        return $token;

    }

    public static function check($token){

        if ( Session::exists(TOKEN_NAME) && $token === Session::get(TOKEN_NAME) ){

            Session::delete(TOKEN_NAME);

            return true;

        }

        return false;

    }
}