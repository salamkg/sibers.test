<?php

namespace app\core;

use PDO;

class Database {

    protected PDO $db;

    public function __construct()
    {
        $config = (include __DIR__ . '/../../config.php')['db'];

        $this->db = new PDO('mysql:host='.$config['host']. ';dbname=' .$config['dbname'], $config['user'], $config['password']);
    }

    public function queryAll($sql, $class)
    {
        $statement = $this->db->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function prepare($sql) {
        return $this->db->prepare($sql);
    }

    public function query($sql, $params = [])
    {
        $stm = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stm->bindvalue(':' . $key, $value);
            }
        }
        $stm->execute();
        return $stm;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastId() {
        return $this->db->lastInsertId();
    }

}