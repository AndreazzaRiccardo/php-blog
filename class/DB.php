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

    public function insert_one($tableName, $columns = array())
    {
        $strCol = '';
        foreach ($columns as $colName => $colValue) {
            $colName = htmlspecialchars($colName);
            $strCol .= ' ' . $colName . ',';
        }

        $strCol = substr($strCol, 0, -1);

        $strColValues = '';
        foreach ($columns as $colName => $colValue) {
            $colValue = htmlspecialchars($colValue);
            $strColValues .= " '" . $colValue . "' ,";
        }
        $strColValues = substr($strColValues, 0, -1);

        $query = "INSERT INTO $tableName ($strCol) VALUES ($strColValues)";

        $this->pdo->exec($query);
    }

    public function delete_one($tableName, $id)
    {
        $id = htmlspecialchars($id);
        $query = "DELETE FROM $tableName WHERE id = $id";

        $this->pdo->exec($query);
    }

    public function update_one($tableName, $id, $columns = array())
    {
        $id = htmlspecialchars($id);
        $strCol = '';
        foreach ($columns as $colName => $colValue) {
            $colName = htmlspecialchars($colName);
            $strCol .= ' ' . $colName . " = '$colValue' ,";
        }

        $strCol = substr($strCol, 0, -1);

        $query = "UPDATE $tableName SET $strCol WHERE id = $id";
        $query = str_replace("'NULL'", "NULL", $query);
        $this->pdo->exec($query);
    }
}