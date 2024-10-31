<?php
namespace karyawanmvc\Config;
require_once "db.php";

use PDO;
use PDOStatement;

class Connection
{
    private PDO $dbh;
    private Array $option;
    private PDOStatement $statement;
    public function __construct(private string $host = DB_HOST,private string $name = DB_NAME, private string $user = DB_USER,private string $pass = DB_PASS)
    {
        $this->option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
        ];

        $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->name",username: $this->user,password: $this->pass,options: $this->option);
    }

    public function query(string $sql): void
    {
        $this->statement =  $this->dbh->prepare($sql);
    }

    public function bind(string $param, mixed $value,  $type = null): void
    {
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value): 
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->statement->bindParam($param,$value,$type);
    }

    public function execute(): void
    {
        $this->statement->execute();
    }

    public function fetch(): mixed
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(): mixed
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }
}