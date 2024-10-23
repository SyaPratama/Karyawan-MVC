<?php

namespace karyawanmvc\Controller;

use ArrayAccess;
use karyawanmvc\Model\Karyawan;

class KaryawanController
{
    public function getKaryawan(): array
    {
        $karyawan = new Karyawan();
        $result = $karyawan->get();
        return $result;
    }

    public function getKaryawanPage(int $min, int $max): array
    {
        $karyawan = new Karyawan();
        $result = $karyawan->getPagination($min, $max);
        return $result;
    }

    public function getKaryawanById(int $id)
    {
        $karyawan = new Karyawan();
        $result = $karyawan->getkaryawanById($id);
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function findKaryawanBydId(int $id): Array | Bool
    {
        $karyawan = new Karyawan();
        $result = $karyawan->getkaryawanById($id);
        return $result;
    }

    public function addKaryawan(): void
    {
        $modelKaryawan = new Karyawan();

        $nik = filter_var($_POST["nik"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nama = filter_var($_POST["nama"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $alamat = filter_var($_POST["alamat"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Check If Has Duplicate Data
        if ($modelKaryawan->getKaryawanByNikOrName($nik) || $modelKaryawan->getKaryawanByNikOrName($nama)) {
            $_SESSION["error"] = "Nama Atau Nik Sudah Digunakan!";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(400);
        }

        // Date Time
        $timezone = new \DateTimeZone("Asia/Jakarta");
        $timestamp = new \DateTime('now', $timezone);
        $unixTime = $timestamp->format("Y-m-d H:i:s");

        // Add Data
        $result = $modelKaryawan->addKaryawan($nik, $nama, $alamat, $unixTime);

        if ($result !== -1) {
            $_SESSION["success"] = "Berhasil Menambahkan Karyawan";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }
        $_SESSION["error"] = "Gagal Menambahkan Karyawan";
        header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }

    public function updateKaryawan(): void
    {
        $modelKaryawan = new Karyawan();

        $id = $_POST["id"];
        $nik = filter_var($_POST["nik"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nama = filter_var($_POST["nama"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $alamat = filter_var($_POST["alamat"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $findKaryawan = $modelKaryawan->getkaryawanById($id);

        // Find Duplicate Data
        if ($findKaryawan["nama"] !== $nama || $findKaryawan["nik"] !== $nik) {
            if ($modelKaryawan->getKaryawanByNikOrName($nik) && $findKaryawan["nik"] !== $nik) {
                $_SESSION["error"] = "Nik Sudah Digunakan!";
                header("Location: {$GLOBALS['BASEURL']}");
                exit(400);
            } else if ($modelKaryawan->getKaryawanByNikOrName($nama) && $findKaryawan["nama"] !== $nama) {
                $_SESSION["error"] = "Nama Sudah Digunakan!";
                header("Location: {$GLOBALS['BASEURL']}");
                exit(400);
            }
        }

        $timeZone = new \DateTimeZone("Asia/Jakarta");
        $timestamp = new \DateTime("now", $timeZone);
        $updateAt = $timestamp->format("Y-m-d H:i:s");

        $result = $modelKaryawan->updateKaryawan($id, $nik, $nama, $alamat, $updateAt);

        if ($result !== -1) {
            $_SESSION["success"] = "Berhasil Update Karyawan!";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }
        $_SESSION["error"] = "Gagal Update Karyawan!";
        header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }

    public function deleteKaryawan(): never
    {
        $modelKaryawan = new Karyawan();
        $id = (int)($_POST["id"]);

        $result = $modelKaryawan->deleteKaryawan($id);
        if($result !== -1)
        {
            $response = [
                "status" => 200
            ];
            echo json_encode($response);
            exit();
        }
        $response = [
            "status" => 400
        ];
        echo json_encode($response);
        exit();
    }

    public function searchKaryawan(string $keyword)
    {
        $modelKaryawan = new Karyawan();
        $result = $modelKaryawan->searchKaryawan($keyword);
        return $result;
    }

    public function searchKaryawanPagination(string $keyword, int $min, int $max): array
    {
        $modelKaryawan = new Karyawan();
        $result = $modelKaryawan->searchKaryawanWithPagination($keyword,$min,$max);
        return $result;
    }
}
