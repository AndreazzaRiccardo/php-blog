<?php

class DB {

    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=' . 'my_blog_db' . ';host=' . 'localhost', 'root', 'root');
    }

    public function query($sql) {
        $query = $this->pdo->query($sql);
        $data = $query->fetchAll();
        return $data;
    }
}