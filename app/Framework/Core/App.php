<?php


namespace App\Framework\Core;

use App\Framework\Core\Routes;

class App
{


    private $controller = '\App\Controllers\HomeController';
    private $action = "index";
    private $args = [];

    private $controllerInstance;

    public function __construct()
    {

        $this->dispatch();

       if(file_exists(INC_ROOT.$this->controller.".php")){

           $this->controllerInstance = new $this->controller();

           if (method_exists($this->controllerInstance , $this->action)){

                if (is_callable([$this->controller , $this->action])){

                    if(empty($this->args)){
                        $this->controllerInstance->{$this->action}();
                    }else{

                        call_user_func_array([$this->controllerInstance , $this->action] , $this->args );

                    }



                }else{



                }

           }else{



           }



       }else{



       }



    }


    private function sanitize()
    {
            return filter_var( rtrim($_GET['url'] , '/') , FILTER_SANITIZE_URL );

    }

    private function dispatch(){

        if(isset($_GET["url"])){


            if(Routes::match($this->sanitize($_GET["url"]) , "GET")){

                $request = Routes::getRequest();

                $this->controller = "\\App\\Controllers\\" . $request["controller"];
                $this->action = $request["action"];

                if (isset($request["params"])){
                    $this->args = $request["params"];
                }



            }
        }

    }



}