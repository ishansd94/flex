<?php


namespace App\Framework\Helpers;

use App\Framework\Helpers\Cookie;


class Session
{
    private static $location = PATH_TO_SESSIONS_STORGE;
    private static $name     = SESSION_NAME;
    private static $session_id;
    private static $session_name;


    //setting up the parameters for the session
    private static function init(){

        ini_set('session.use_strict_mode', 1);
        ini_set( 'session.cookie_httponly', 1 );
        session_save_path(self::$location);
        session_name(Hash::create(self::$name));
    }


    //initiating a session
    public static function start(){

        if (session_status() !== 2 ) {

            self::init();
            session_start();
            self::$session_id = session_id();
            self::$session_name = session_name();

        }

        self::validate();
    }


    //ending the current session
    public static function end(){

        session_unset();
        session_destroy();

    }

    //deleting session cookie
    public static function deleteCookie(){
        Cookie::delete(SESSION_NAME);
    }

    //regenarting the session id
    public static function regenerate($flag=true){

        session_regenerate_id($flag);

    }

    //get info about the current session
    public static function info(){
        return  [
            "id"     => self::$session_id,
            "name"   => self::$session_name,
            "values" => $_SESSION
        ];
    }

    //get all the session set variables
    public static function all(){
        return  $_SESSION;
    }

    //check whether a particular item exist in the session
    public static function exists($path){

        $indexes = explode("." , $path);

        $session = $_SESSION;

        $exists = false;

        foreach ($indexes as $index){

            $exists = false;

            if (isset($session[$index])){
                $exists = true;
                $session = $session[$index];               

            }
        }

        return $exists;

    }

    //retrieve a particulr sesstion value
    public static function get($path){

        $indexes = explode("." , $path);

        $session = $_SESSION;

        foreach ($indexes as $index){

            if (isset($session[$index])){

                $session = $session[$index];

            }else{

                return null;

            }
        }

        return $session;


    }


    //setting a session value
    public static function set($path , $value){

        $indexes = explode("." , $path);

        $counter = $indexes;

        $string_builder  = '$_SESSION' ;

        foreach ($indexes as $index){

            $string_builder .= '["'.$index.'"]';

            $isarr = ' return is_array( '. $string_builder . ');';

            if ( ! empty( $counter )  && ! eval( $isarr ) ){

                eval( $string_builder . ' = [];' );
            }

            unset( $counter[ array_search( $index , $counter)] );

        }

        $str = $string_builder. ' = ' . "\$value" . ';';

        eval($str) ;
    }

    //delete a particular session value
    public static function delete($path){

        $indexes = explode("." , $path);

        $string_builder  = '$_SESSION' ;

        foreach ($indexes as $index){

            $string_builder .= '["'.$index.'"]';

        }

        

        eval( "unset( $string_builder );" );

    }


    //session security management
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

        self::set("UPDATED_AT" , time() );

    }

    // retrieving and deleting the selected index
    public static function pull($index){

        $session  = self::get($index);

        self::delete($index);

        return $session;

    }

    public static function flush(){
        unset($_SESSION);
    }


    public static function flash($index , $msg = null){

        if (self::exists( "_flash.{$index}" ) && $msg === null){             

            return self::pull("_flash.".$index);

        }else
            if ( !self::exists("_flash.{$index}")  && $msg != null ) {

                self::set("_flash.".$index , $msg);

                return;
            }
           
    }

}