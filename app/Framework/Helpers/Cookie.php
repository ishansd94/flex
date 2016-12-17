<?php


namespace App\Framework\Helpers;


class Cookie
{

    public static function get($name){

        $name = Hash::create($name);

        return $_COOKIE[$name];

    }

    public static function remove($name){

        $name = Hash::create($name);

        unset($_COOKIE[$name]);
    }


    public static function delete($name){

        if(self::create( $name , '' , 1) && self::create( $name , false) ){

            self::remove($name);

            return true;
        }

        return false;

    }

    public static function create($name , $value , $expiry = COOKIE_EXPIRY , $path="/" , $domain = "" , $secure = false, $httponly = true){

        $name = Hash::create($name);

        if(setcookie($name , $value , $expiry , $path , $domain , $secure , $httponly ))
            return true;

        return false;
    }
}