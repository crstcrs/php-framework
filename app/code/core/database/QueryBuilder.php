<?php

class QueryBuilder  {
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function select($query, $params = []) {
        if(empty($query)) throw new \Exception('PDO Statement is empty');
        $sql = $this->pdo->prepare($query);
        $sql->execute($params);

        return $sql->fetchAll(PDO::FETCH_CLASS);
    }

    public function update($query, $params = []) {
        if(empty($query)) throw new \Exception('PDO Statement is empty');
        $sql = $this->pdo->prepare($query);
        $sql->execute($params);
    }

}