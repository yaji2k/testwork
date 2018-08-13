<?php
namespace models;

class BaseModel
{

    public $db;

    public function __construct()
    {
        $this->db = DB::connectDb();
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM groups";
        $result = $this->db->query($sql);
        debug($result);
        return $result;
    }

    public function select($table, $column, $group)
    {
        $sql = "SELECT * FROM {$table} WHERE {$column} = ?";
        return $this->db->query($sql, [$group]);
    }

    public function query($sql, $params = [])
    {
        return $this->db->query($sql, $params);
    }
    
    public function execute($sql, $params = [])
    {
        return $this->db->execute($sql, $params);
    }

    public function count($sql, $params = [])
    {
        return $this->db->count($sql, $params);
    }

    public function checkCount($table, $column, $id)
    {
        $sql = "SELECT * FROM {$table} WHERE {$column} = ?";
        return $this->db->count($sql, [$id]);
    }
}
