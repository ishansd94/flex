<?php
/**
 * Created by PhpStorm.
 * User: ishan
 * Date: 17/12/2016
 * Time: 12:24 PM
 */

namespace App\Framework\Helpers;


class Password
{
    public static function salt($length = SALT_LENGTH){
        return Hash::randomString($length);
    }

    public static function hash($string , $salt){
        return hash( "sha256" , $string . $salt  );
    }

    public static function verify($password , $hash , $salt){
        if ($hash === self::hash($password , $salt))
            return true;

        return false;
    }



}