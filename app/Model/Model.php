<?php

namespace karyawanmvc\Model;

use karyawanmvc\Config\Connection;

abstract Class Model
{
    protected Connection $db;
    public function __construct()
    {
        $this->db = new Connection();
    }    
}