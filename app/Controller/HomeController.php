<?php

namespace karyawanmvc\Controller;

use karyawanmvc\App\View;

class HomeController implements Controller
{
    public function index(): void
    {
        $karyawan = new KaryawanController();
        $karyawanResult = $karyawan->getKaryawan();

        $totalHalaman = 25;
        $totalData = count($karyawanResult);
        $totalPage = ceil($totalData / $totalHalaman);
        $activePage = $_GET["page"] ?? 1;
        $mainPage = $totalHalaman * $activePage - $totalHalaman;
        $karyawanResult = $karyawan->getKaryawanPage($mainPage,$totalHalaman);

        View::render("Dashboard/index", [
            "title" => "Home Page Karyawan",
            "karyawan" => $karyawanResult,
            "totalPage" => $totalPage,
            "activePage" => $activePage,
            "mainPage" => $mainPage
        ]);
    }

    public function dashboard(): void
    {
        View::render("Dashboard/dashboard", [
            "title" => "Dashboard Karyawan"
        ]);
    }

    public function signOut(): void
    {
        if (isset($_POST["logout"]) && $_POST["logout"] === "logout") {
            session_destroy();
            setcookie("LOGIN_ID", "", time() - 86400 * 100, '/');
            header("Location: /");
            exit(200);
        }
        header("Location: /");
        exit(400);
    }
}
