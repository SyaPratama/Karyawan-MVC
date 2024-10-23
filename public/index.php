<?php
ob_start();
session_start();

require __DIR__ . "/../vendor/autoload.php";

use karyawanmvc\App\Router;
use karyawanmvc\Controller\HomeController;
use karyawanmvc\Controller\KaryawanController;
use karyawanmvc\Controller\NilaiController;
use karyawanmvc\Controller\UserController;
use karyawanmvc\Middleware\AuthMiddleware;


$url = $_SERVER["PHP_SELF"];
$servername = $_SERVER["SERVER_NAME"];
$url = rtrim($url,'public/index.php');
$GLOBALS["BASEURL"]  = "http://$servername" . "$url";

if(isset($_COOKIE["LOGIN_ID"])){
    $cookieId = $_COOKIE["LOGIN_ID"];
    $userController = new UserController();
    $result = $userController->getUserById($cookieId);
    if(count($result) > 0){
        $_SESSION["LOGGED"] = $_COOKIE["LOGIN_ID"];
    }
}


if(!isset($_SESSION["LOGGED"])){
    Router::add("GET", "/", UserController::class, "index",[AuthMiddleware::class]);
}else{
    Router::add("GET", "/", HomeController::class, "index", [AuthMiddleware::class]);
    Router::add("GET", "/penilaian", HomeController::class, "penilaian", [AuthMiddleware::class]);
    Router::add("GET","/karyawanId",KaryawanController::class,"getKaryawanById",[AuthMiddleware::class]);
}

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_SESSION["LOGGED"])){
        Router::add("POST", "/login", UserController::class, "login");
        Router::add('POST', '/register', UserController::class, "register");
    }else{
        Router::add("POST", "/signOut", HomeController::class, "signOut", [AuthMiddleware::class]);
        Router::add("POST","/addKaryawan", KaryawanController::class, "addKaryawan",[AuthMiddleware::class]);
        Router::add("POST","/updateKaryawan", KaryawanController::class, "updateKaryawan",[AuthMiddleware::class]);
        Router::add("POST","/deleteKaryawan", KaryawanController::class, "deleteKaryawan",[AuthMiddleware::class]);
        Router::add("POST","/addNilai",NilaiController::class,"addNilai",[AuthMiddleware::class]);
    }
}

Router::run();
