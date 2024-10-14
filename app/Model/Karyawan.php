<?php

namespace karyawanmvc\Model;

class Karyawan extends Model
{
    public function get(): Array
    {
        $this->db->query("SELECT * FROM karyawan");
        $this->db->execute();
        return $this->db->fetchAll();
    }

    public function getkaryawanById(int $id): Array | bool
    {
        $this->db->query("SELECT * FROM karyawan WHERE id = :id");
        $this->db->bind("id",$id);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function getKaryawanByNikOrName(string $keyword): Array | Bool
    {
        $this->db->query("SELECT * FROM karyawan WHERE nik = :nik OR nama = :nama ");
        $this->db->bind("nik",$keyword);
        $this->db->bind("nama",$keyword);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function getPagination(int $min, int $max): Array
    {
        $this->db->query("SELECT * FROM karyawan LIMIT $min,$max");
        $this->db->execute();
        return $this->db->fetchAll();
    }

    public function addKaryawan(string $nik, string $nama, string $alamat, string $unixTimeStamp): int
    {
        $this->db->query("INSERT INTO karyawan VALUES(:id,:nik,:nama,:alamat,:created_at,:updated_at)");
        $this->db->bind("id","");
        $this->db->bind("nik",$nik);
        $this->db->bind("nama",$nama);
        $this->db->bind("alamat",$alamat);
        $this->db->bind("created_at",$unixTimeStamp);
        $this->db->bind("updated_at",$unixTimeStamp);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateKaryawan(int $id ,string $nik,string $nama, string $alamat, string $updatedAt): int
    {
        $this->db->query("UPDATE karyawan SET nik = :nik, nama = :nama, alamat = :alamat, updated_at = :updated_at WHERE id = :id");
        $this->db->bind("id", $id);
        $this->db->bind("nik",$nik);
        $this->db->bind("nama",$nama);
        $this->db->bind("alamat",$nik);
        $this->db->bind("updated_at",$updatedAt);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteKaryawan(int $id)
    {
        $this->db->query("DELETE FROM karyawan WHERE id = :id");
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}