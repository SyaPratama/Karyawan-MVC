<?php

namespace karyawanmvc\App;

class Router
{


    static private array $routes = [];

    static public function add(string $method, string $path, string $controller, string $function, array $middlewares = []): void
    {
        array_push(self::$routes, [
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middleware" => $middlewares,
        ]);
    }

    static public function run(): void
    {
        $path = "/";
        $url = self::parsingUrl();
        $active = true;

        if (isset($url[0])) {
            $path =  "/" . join("/",$url);
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach (self::$routes as $route) {
            $pattern = "#^". $route["path"] ."$#";
            if (preg_match($pattern, $path, $resultVar) && $method == $route["method"]) {
                foreach ($route["middleware"] as $middleware) {
                    $instanceMiddleware = new $middleware;
                    $instanceMiddleware->before();
                }

                $controller = new $route["controller"];
                $function = $route["function"];
                $active = false;

                array_shift($resultVar);
                call_user_func_array([$controller, $function], $resultVar);
            }
        }
        if (isset($url[0]) && $active) {
            header("Location: {$GLOBALS['BASEURL']}");
            exit();
        }
    }

    static public function parsingUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], '/');
            // Clean Url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
