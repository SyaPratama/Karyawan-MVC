<?php
namespace karyawanmvc\Model;

class Role extends Model
{
    public function get(): Array
    {
        $this->db->query("SELECT * FROM role");
        $this->db->execute();
        return $this->db->fetchAll();
    }
}