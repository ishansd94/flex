<?php

    use Illuminate\Database\Capsule\Manager as Capsule;
    use App\Framework\Helpers\Config;

    //initiating eloqouent - ORM
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


    //initializing twig - templating engine
    $loader = new Twig_Loader_Filesystem(INC_ROOT."/app/Resources/Views");

    $twig = new Twig_Environment($loader , [
        'cache' => INC_ROOT."/public/cache/views",
        'auto_reload' => true
    ]);

    function view( $file , $data=[] ) {

        global $twig;

        $paths = explode("." , $file);

        $filepath = "";

        foreach ($paths as $path){
            $filepath .= $path . "/";
        }

        echo $twig->render(rtrim($filepath , "/" ).".html" , $data);

    }





