<?php

namespace karyawanmvc\Model;

class Nilai extends Model
{
    public function addNilai(int $id,int $disiplin,int $kerapian,int $kreativitas,string $created_at): int
    {
        $this->db->query("INSERT INTO nilai VALUES(:id,:id_karyawan,:disiplin,:kerapian,:kreativitas,:created_at)");
        $this->db->bind("id","");
        $this->db->bind('id_karyawan',$id);
        $this->db->bind('disiplin',$disiplin);
        $this->db->bind("kerapian",$kerapian);
        $this->db->bind("kreativitas",$kreativitas);
        $this->db->bind("created_at",$created_at);
        $this->db->execute();
        return $this->db->rowCount();
    }
}