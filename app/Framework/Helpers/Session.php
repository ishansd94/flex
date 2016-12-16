<?php


namespace App\Framework\Helpers;

use App\Framework\Helpers\Cookie;


class Session
{
    private static $location = PATH_TO_SESSIONS_STORGE;
    private static $name     = SESSION_NAME;
    private static $session_id;
    private static $session_name;

    private static function init(){

        ini_set('session.use_strict_mode', 1);
        session_save_path(self::$location);
        session_name(self::$name);

    }

    public static function start(){

        if (session_status() !== 2 ) {

            self::init();
            session_start();
            self::$session_id = session_id();
            self::$session_name = session_name();

        }

        self::validate();
    }

    public static function end(){

        session_unset();
        session_destroy();

    }

    public static function deleteCookie(){
        Cookie::delete(session_name());
    }


    public static function regenerate($flag=true){

        session_regenerate_id($flag);

    }

    public static function info(){
        return  [
            "id"     => self::$session_id,
            "name"   => self::$session_name,
            "values" => $_SESSION
        ];
    }

    public static function exists($sessionName){
        return (isset($_SESSION[$sessionName])) ? true : false ;
    }

    public static function get($sessionName){
        return $_SESSION[$sessionName];
    }

    public static function set($index , $value){
        $_SESSION[$index] = $value;
    }

    private static function validate(){

        /**
         * preventing session fixation
         */
        if (!self::exists("CREATED_AT")) {
            self::set("CREATED_AT" , time());
        }else
            if (time() - self::get("CREATED_AT") > 1800) { // session started more than 30 minutes ago
                self::regenerate();    // change session ID for the current session and invalidate old session ID
                self::set("CREATED_AT" , time());  // update creation time
            }

        /**
         * invalidating after timeout
         */
        if (self::exists("UPDATED_AT") && ( time() - self::get("UPDATED_AT") > SESSION_TIMEOUT ) ){
            self::end();
        }

        self::set("UPDATED_AT" , time());

    }
}