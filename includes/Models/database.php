<?php

class Database {
    private $connection;

    public function __construct() {
        $this->dbConnect();
    }

    private function dbConnect() {
        $this->connection = new Mysqli('localhost', 'andrej', 'Andrej2341923545!@', 'kanye');
        if($this->connection->connect_errno) {
            die($this->connection->connect_error);
        }
    }

    public function Query($sql) {
        $query = $this->connection->query($sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }

    public function checkQuery() {
        if($this->connection->errno) {
            die($this->connection->error);
        }
    }

    public function escapeString($string) {
        return $this->connection->real_escape_string($string);
    }
}
$database = new Database();