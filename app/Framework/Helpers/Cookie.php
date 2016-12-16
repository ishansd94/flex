<?php


namespace App\Framework\Helpers;


class Cookie
{

    public static function delete($name){

        if(self::create( $name , '' , -42000))
            return true;

        return false;

    }

    public static function create($name , $value , $expiry , $path="/" , $domain = "" , $secure = false, $httponly = false){
        if(setcookie($name , $value , time() + $expiry , $path , $domain , $secure , $httponly ))
            return true;

        return false;
    }
}