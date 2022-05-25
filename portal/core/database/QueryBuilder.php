<?php

class QueryBuilder {

    public $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function selectAll($table) {
        $sql = sprintf("select * from %s", $table);
//                echo $sql;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAll1($table) {
        try {
            $sql = sprintf("SELECT * FROM %s", $table);
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function insertAll($table, $queryline) {
        try {
            $sql = sprintf("insert into %s values (%s)", $table, $queryline);
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
            // return $sql;
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }
    
    public function insertAllE($query) {
        try {
            $statement = $this->pdo->prepare($query);
            return $statement->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function deleteAll($table, $condition) {
        try {
            $sql = sprintf("delete from %s where %s", $table, $condition);
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function updateAll($table, $values, $condition) {
        try {
            $sql = sprintf("update %s set %s where %s", $table, $values, $condition);
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

    public function selectSpecific($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table);
//echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function selectCount($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table);
//            echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchColumn();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function specialQuery($query) {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

}
