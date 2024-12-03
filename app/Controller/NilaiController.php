<?php

namespace karyawanmvc\Controller;

use karyawanmvc\Model\Nilai;

class NilaiController
{
    public function addNilai(): void
    {
        $modelNilai = new Nilai();
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        $disiplin = filter_var($_POST["disiplin"], FILTER_SANITIZE_NUMBER_INT);
        $kerapian = filter_var($_POST["kerapian"], FILTER_SANITIZE_NUMBER_INT);
        $kreativitas = filter_var($_POST["kreativitas"], FILTER_SANITIZE_NUMBER_INT);
        $timezone = new \DateTimeZone("Asia/Jakarta");
        $timestamp = new \DateTime('now', $timezone);
        $created_at = $timestamp->format("Y-m-d H:i:s");

        $result = $modelNilai->addNilai($id, $disiplin, $kerapian, $kreativitas, $created_at);

        if ($result !== -1) {
            $_SESSION["success"] = "Berhasil Menambahkan Nilai Karyawan!";
              header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }

        $_SESSION["error"] = "Gagal Menambahkan Nilai Karyawan!";
          header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }

    public function getNilai(): Array
    {
        $modelNilai = new Nilai();
        $result = $modelNilai->getNilai();
        return $result;
    }

    public function getPenilaianById(int $id)
    {
        $karyawan = new Nilai();
        $result = $karyawan->findNilaiById($id);
        header("Content-Type: application/json");
        echo json_encode($result);
    }


    public function deletePenilaian(): void
    {
      $id = $_POST["id"];
      $model = new Nilai();
      $result = $model->deletePenilaian($id);
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

    public function updateNilai(): void
    {
        $model = new Nilai();

        $id = $_POST["id"];
        $disiplin = filter_var($_POST["disiplin"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $kerapian = filter_var($_POST["kerapian"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $kreativitas = filter_var($_POST["kreativitas"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $findNilai = $model->findNilaiById($id);

        $timeZone = new \DateTimeZone("Asia/Jakarta");
        $timestamp = new \DateTime("now", $timeZone);
        $updateAt = $timestamp->format("Y-m-d H:i:s");

        $result = $model->updateNilai($id, $disiplin, $kerapian, $kreativitas, $updateAt);

        if ($result !== -1) {
            $_SESSION["success"] = "Berhasil Update Nilai!";
            header("Location: {$GLOBALS['BASEURL']}");
            exit(200);
        }
        $_SESSION["error"] = "Gagal Update Nilai!";
        header("Location: {$GLOBALS['BASEURL']}");
        exit(400);
    }
}
