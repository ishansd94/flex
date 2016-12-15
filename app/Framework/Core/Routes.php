<?php

namespace App\Framework\Core;

/**
 *
 */
class Routes
{
    protected static $routes  = [];

    protected static $request = [];


    private static function add($route , $type ,$action = []){


        //convert the route to reg exp - escape forward slashes
        $route = preg_replace('/\//', '\\/', $route );

        //convert variables : {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z0-9]+)', $route);

        //convert variables with custom regular expressions.
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //add start end delimetrs.
        $route = '/^'.$route.'$/i';

        self::$routes[$route][$type] = $action;

    }

    //ex: Route::get('auth/login' , 'AuthController@login');
    public static function get( $route , $action ){



        $controller_action = explode('@' , $action);

        self::add($route , 'GET' ,["controller" => $controller_action[0] ,
                            "action"     => $controller_action[1]]
        );

    }

    public static function post( $route , $action ){

        $controller_action = explode('@' , $action);

        self::add($route , 'POST' , ["controller" => $controller_action[0] ,
                "action"     => $controller_action[1]]
        );

    }

    public static function match($url , $type){


        foreach (self::$routes as $route => $action) {

            if (preg_match($route, $url, $matches) && !empty(self::$routes[$route]) ) {

                self::$request = self::$routes[$route][$type];
                self::$request["request"] = $url;
                self::$request["type"] = $type;

                if (!empty($matches)) {

                    foreach ($matches as $key => $match) {
                        if (is_string($key)) {
                            self::$request["params"][$key] = $match;
                        }
                    }

                }

                return true;

            }


        }

        return false;

    }

    public static function getRoutes(){
        return self::$routes;
    }

    public static function getRequest(){
        return self::$request;
    }


}