<?php

namespace App\Framework\Helpers;


class Redirect
{

    public static function to($url){

        header( 'Location:'.HTTP_ROOT."/".$url );

    }

}