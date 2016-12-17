<?php

/**
 * Defining all the Core services which are required globally.
 */


use Illuminate\Database\Capsule\Manager as Capsule;
use App\Framework\Helpers\Config;

/**
 *    Twig view rendering function
 *
 */

    $loader = new Twig_Loader_Filesystem(PATH_TO_VIEWS);

    $twig = new Twig_Environment($loader , [
        'cache' => PATH_TO_CACHE,
        'auto_reload' => true
    ]);

    $lexer = new Twig_Lexer($twig , [

        "tag_block"     => ["{","}"],
        "tag_variable"  => ["{{","}}"]

    ]);

    $twig->setLexer($lexer);


    function view( $file , $data=[] ) {

        global $twig;

        $paths = explode("." , $file);

        $filepath = "";

        foreach ($paths as $path){
            $filepath .= $path . "/";
        }

        echo $twig->render(rtrim($filepath , "/" ).".twig" , $data);

    }




/**
 * Initializing Eloquent
 */
function initEloqouent(){

    $capsule =  new Capsule();

    $capsule->addConnection([
        'driver'    => Config::get("database.type"),
        'host'      => Config::get("database.host"),
        'database'  => Config::get("database.dbname"),
        'username'  => Config::get("database.username"),
        'password'  => Config::get("database.password"),
        'charset'   => Config::get("database.charset"),
        'collation' => Config::get("database.collation"),
        'prefix'    => Config::get("database.prefix")
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();
}
