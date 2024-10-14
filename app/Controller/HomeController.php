<?php

namespace karyawanmvc\Controller;

use karyawanmvc\App\View;

class HomeController implements Controller
{
    public function index(): void
    {
        $karyawan = new KaryawanController();
        $karyawanResult = $karyawan->getKaryawan();

        $totalHalaman = 20;
        $totalData = count($karyawanResult);
        $totalPage = ceil($totalData / $totalHalaman);
        $activePage = $_GET["page"] ?? 1;
        $mainPage = $totalHalaman * $activePage - $totalHalaman;

        if (isset($_GET["search"]) && isset($_GET["page"])) {
            $keyword = filter_var($_GET["search"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $karyawanResult = $karyawan->searchKaryawan($keyword);
            $totalData = count($karyawanResult);
            $totalPage = ceil($totalData / $totalHalaman);
            $karyawanResult = $karyawan->searchKaryawanPagination($keyword,$mainPage,$totalHalaman);

        } else if (isset($_GET["search"])) {
            $keyword = filter_var($_GET["search"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $karyawanResult = $karyawan->searchKaryawan($keyword);
            $totalData = count($karyawanResult);
            $totalPage = ceil($totalData / $totalHalaman);
            $karyawanResult = $karyawan->searchKaryawanPagination($keyword,$mainPage,$totalHalaman);
        }else{
            $karyawanResult = $karyawan->getKaryawanPage($mainPage, $totalHalaman);
        }

        View::render("Dashboard/index", [
            "title" => "Home Page Karyawan",
            "karyawan" => $karyawanResult,
            "totalPage" => $totalPage,
            "activePage" => $activePage,
            "mainPage" => $mainPage
        ]);
    }

    public function penilaian(): void
    {
        View::render("Dashboard/penilaian", [
            "title" => "Dashboard Penilaian Karyawan"
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
