<?php

namespace karyawanmvc\App;

class Router{
    static private Array $routes = [];

   static public function add(string $method,string $path,string $controller,string $function,array $middlewares = []): void{
        self::$routes[] = [
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middleware" => $middlewares,
        ];
    }

    static public function run(): void{
        $path = "/";

        if(isset($_SERVER["PATH_INFO"])){
            $path = $_SERVER["PATH_INFO"];
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach(self::$routes as $route)
        {
            $pattern =  "#^". $route["path"]  ."$#";
            if( preg_match($pattern,$path,$result) && $method == $route["method"]){
                foreach($route["middleware"] as $middleware){
                    $instance = new $middleware;
                    $instance->before();
                }

                $controller = new $route["controller"];
                $function = $route["function"];

                array_shift($result);
                call_user_func_array([$controller,$function],$result);
                return;
            }
        }
        http_response_code(404);
        View::render("NotFound/index",[
            "title" => "Not Found",
            "content" => "NOT FOUND PAGE"
        ]);
    }
}