<?php

namespace App\Framework\Helpers;

class Config{

    private static $_file = PATH_TO_CONFIG;

    public static function get($path = null){

        $config = parse_ini_file(self::$_file , true);

        if($path){
            $path = explode('.' , $path);
            foreach($path as $index){
                if(isset($config[$index])){
                    $config = $config[$index];
                }
            }

            return $config;
        }else
            return '';

    }


}