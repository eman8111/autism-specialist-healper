<?php

namespace Project\Classes;

abstract class Db
{
    protected $conn;
    protected $table;

    public function connect()
    {
        $this->conn = mysqli_connect(SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }
    public function query($query)
    {
        return mysqli_query($this->conn, $query);
    }
    public function select(string $fields = "*", $conditions)
    {
        $query = "SELECT $fields FROM $this->table WHERE $conditions";
        return mysqli_query($this->conn, $query);
    }

    public function selectAs(string $fields = "*", $tables,  $conditions): array
    {
        $query = "SELECT $fields FROM $tables WHERE $conditions";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function selectAll(string $fields = "*"): array
    {
        $query = "SELECT $fields FROM $this->table";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function selectId(string $fields = "*", $id)
    {
        $query = "SELECT $fields FROM $this->table WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }
    public function selectWhere(string $fields = "*", $conditions): array
    {
        $query = "SELECT $fields FROM $this->table WHERE $conditions";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function insert($fields, $values): bool
    {
        $query = "INSERT INTO $this->table ($fields) VALUES ($values)";
        return mysqli_query($this->conn, $query);
    }
    public function update(string $set, $conditions): bool
    {
        $query = "UPDATE $this->table SET $set WHERE $conditions";
        return mysqli_query($this->conn, $query);
    }

    public function delete($conditions): bool
    {
        $query = "DELETE FROM $this->table WHERE $conditions";
        return mysqli_query($this->conn, $query);
    }
}