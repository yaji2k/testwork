<?php
namespace models;

class DB
{

    public $pdo;
    private static $connect;

    private function __construct()
    {
        $conf = require WWW . '/configs/db_config.php';
        try {
            $this->pdo = new \PDO($conf['dsn'], $conf['user'], $conf['password'], $conf['opt']);
        } catch (\PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }

    public static function connectDb()
    {
        if (null === self::$connect) {
            self::$connect = new self;
        }
        return self::$connect;
    }

    public function query($sql, $param = [])
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute($param)) {
            return $stmt->fetchAll();
        }
    }

    public function count($sql, $param = [])
    {
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute($param)) {
            return $stmt->rowCount();
        }
    }

    public function execute($sql, $param = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($param);
    }

    private function __clone()
    {
        
    }

    private function __wakeup()
    {
        
    }
}
