<?php

namespace karyawanmvc\Controller;

use ArrayAccess;
use karyawanmvc\App\View;
use karyawanmvc\Model\Role;
use karyawanmvc\Model\User;

class UserController implements Controller
{
    public function index(): void
    {
        $role = new Role();
        $result = $role->get();
        
        View::render("Home/index", [
            "title" => "Welcome To Karyawan Website",
            "role" => $result
        ]);
    }

    public function register(): void
    {
        $model = new User();
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $level = (int)(filter_var($_POST["level"], FILTER_SANITIZE_NUMBER_INT));
        $passHash = password_hash($password, PASSWORD_BCRYPT);

        $timezone = new \DateTimeZone("Asia/Jakarta");
        $timestamp = new \DateTime('now', $timezone);
        $unixTime = $timestamp->format('Y-m-d H:i:s');

        // check if email or username already
        if ($model->getEmailOrUsername($email) || $model->getEmailOrUsername($username)) {
            $_SESSION["error"] = "Email Atau Username User Sudah Ada!";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(400);
        }

        $result = $model->registration($email, $username, $passHash, $level, $unixTime);
        if ($result !== -1) {
            $_SESSION["success"] = "Berhasil Menambahkan User!";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }
        $_SESSION["error"] = "Gagal Menambahkan User!";
        header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }

    public function login(): void
    {

        $model = new User();

        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $findEmail = $model->getEmailOrUsername($email);
        if ($findEmail && password_verify($password, $findEmail["password"])) {
            $hashId = hash('sha256', $findEmail["id"]);
            if (isset($_POST["remember"]) && $_POST["remember"] == "on") {
                setcookie("LOGIN_ID", $hashId, time() + 86400);
                header("Location: {$GLOBALS['BASEURL']}");
                exit(200);
            }
            setcookie("LOGIN_ID", $hashId, time() + 86400 * 30);
            header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }
        $_SESSION["error"] = "Email Atau Password Salah!";
        header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }

    public function getUserById(string $hashId): Array
    {
        $model = new User(); 

        $result = $model->get();

        $arr = [];
        foreach($result as $user){
            if(hash("sha256",$user["id"]) === $hashId)
            {
                $arr[] = $user;
            }
        }

        return $arr;
    }
}
