<?php

namespace karyawanmvc\App;
use karyawanmvc\Controller\UserController;

class View
{
    static public function render(string $view,$model): void
    {
        if(isset($_SESSION["LOGGED"])){
            $sessionId = $_COOKIE["LOGIN_ID"];
            $userController = new UserController();
            $user = $userController->getUserById($sessionId);
        }
        $BASEURL = "http://{$_SERVER['HTTP_HOST']}";
        require __DIR__ . "/../View/Templates/header.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/Templates/footer.php";
    }
}