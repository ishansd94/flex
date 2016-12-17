<?php

namespace App\Framework\Helpers;


class Hash
{
    public static function randomString( $length = 32 ){

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        return substr(str_shuffle($chars),0,$length);
    }


    public static function generate($length=null){

        if ( $length != null ){
            return substr(hash( HASH_ALGO , self::randomString()) , 0 , $length );
        }

        return hash( HASH_ALGO , self::randomString() );

    }

    public static function unique(){
        return hash(HASH_ALGO , uniqid());
    }

    public static function create($string){
        return hash(HASH_ALGO, $string);
    }



}