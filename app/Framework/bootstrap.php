<?php

/**
 * This file is responsible for setting up the core services and bootstraping the app with parameters
 */

    use App\Framework\Helpers\Session;


    /**
     *Applocation constansts are declared here.
    */

    //path to the configuration file
    define("PATH_TO_CONFIG" , INC_ROOT."/app/Config/configuration.ini");

    //path for the twig view files.
    define("PATH_TO_VIEWS" , INC_ROOT."/app/Resources/Views");
    //path for the view file cache.
    define("PATH_TO_CACHE" , INC_ROOT."/app/Framework/Storage/cache/views" );

    //path for the session file storege
    define("PATH_TO_SESSIONS_STORGE" , INC_ROOT."/app/Framework/Storage/sessions");
    //name for the sesstion
    define("SESSION_NAME" , "flex.dev" );
    //timeout for sessions -- 30min
    define("SESSION_TIMEOUT" , 1800);

    //timeout for cookie expiry in s default - 7 days
    define("COOKIE_EXPIRY" , time()+604800);

    //define token name for session
    define("TOKEN_NAME" , "_token");

    //defining hash algo
    define("HASH_ALGO" , 'sha256' );

    //defining the salt length
    define("SALT_LENGTH" , 32 );







    //Requiring in global level core services
    require_once INC_ROOT."/app/Framework/services.php";

    //Boooting up the Eloquent ORM
    initEloqouent();

    //Initializing the user session
    Session::start();













