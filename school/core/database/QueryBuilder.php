<?php

class QueryBuilder {

    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function selectAll($table) {
        try {
            $sql = sprintf("SELECT * FROM %s", $table); //echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function selectQs($table) {
        $sql = sprintf("select * from %s", $table);
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($dbname, $values) {
        try {
            $sql = "INSERT INTO $dbname VALUES(" . $values . ")"; //echo $sql;
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function insertwithlastid($dbname, $values) {
        try {
            $sql = "INSERT INTO $dbname VALUES(" . $values . ")"; //echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function update($dbname, $values) {
        try {
            $sql = "UPDATE $dbname SET $values"; //echo $sql;
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function delete($dbname) {
        try {
            $sql = "DELETE FROM $dbname";
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function selectSpecific($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table);
//            echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function sample($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table); //echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function selectSingle($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table); 
            //echo $sql;
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_LAZY);
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

    public function RowCount($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table);
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->rowCount();
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function selectSpecificAll($fields, $table) {
        try {
            $sql = sprintf("SELECT %s FROM %s", $fields, $table);
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function insertAll($query) {
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

    public function updateAll($query) {
        try {
            $sql = sprintf("%s", $query);
            $statement = $this->pdo->prepare($sql);
            return $statement->execute();
        } catch (PDOException $e) {
            return "Error :" . $e->getMessage();
        }
    }

}
