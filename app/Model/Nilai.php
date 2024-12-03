<?php

namespace karyawanmvc\Model;

class Nilai extends Model
{
    public function getNilai(): Array
    {
        $this->db->query("SELECT * FROM nilai");
        $this->db->execute();
        return $this->db->fetchAll();
    }

    public function addNilai(int $id,int $disiplin,int $kerapian,int $kreativitas,string $created_at): int
    {
        $this->db->query("INSERT INTO nilai VALUES(:id,:id_karyawan,:disiplin,:kerapian,:kreativitas,:created_at)");
        $this->db->bind("id",0);
        $this->db->bind('id_karyawan',$id);
        $this->db->bind('disiplin',$disiplin);
        $this->db->bind("kerapian",$kerapian);
        $this->db->bind("kreativitas",$kreativitas);
        $this->db->bind("created_at",$created_at);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function findNilaiById(int $id): Array
    {
        $this->db->query("SELECT * FROM nilai WHERE id = :id");
        $this->db->bind("id",$id);
        $this->db->execute();
        return $this->db->fetch();
    }

    public function deletePenilaian(int $id): int
    {
        $this->db->query("DELETE FROM nilai WHERE id = :id");
        $this->db->bind('id',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateNilai(int $id ,string $disiplin,string $kerapian, string $kreativitas, string $updatedAt): int
    {
        $this->db->query("UPDATE nilai SET disiplin = :disiplin, kerapian = :kerapian, kreativitas = :kreativitas, updated_at = :updated_at WHERE id = :id");
        $this->db->bind("id", $id);
        $this->db->bind("disiplin",$disiplin);
        $this->db->bind("kerapian",$kerapian);
        $this->db->bind("kreativitas",$kreativitas);
        $this->db->bind("updated_at",$updatedAt);
        $this->db->execute();

        return $this->db->rowCount();
    }
}