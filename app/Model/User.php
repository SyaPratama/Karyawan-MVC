<?php

namespace karyawanmvc\Model;

class User extends Model
{ 

    public function get(): Array
    {
        $this->db->query("SELECT * FROM user");
        $this->db->execute();
        return $this->db->fetchAll();
    }

    public function getEmailOrUsername(string $keyword): Mixed
    {
        $this->db->query("SELECT * FROM user WHERE email = :email OR username = :username");
        $this->db->bind('email',$keyword);
        $this->db->bind('username',$keyword);
        $this->db->execute();
        return $this->db->fetch();
    }
    
    public function registration(string $email,string $username, string $password, int $level,string $timestamp): int
    {
        $this->db->query("INSERT INTO user VALUES(:id,:email,:username,:password,:level,:created_at)");
        $this->db->bind("id",0);
        $this->db->bind("email",$email);
        $this->db->bind("username",$username);
        $this->db->bind("password",$password);
        $this->db->bind("level",$level);
        $this->db->bind('created_at',$timestamp);
        $this->db->execute();
        return $this->db->rowCount();
    }
}