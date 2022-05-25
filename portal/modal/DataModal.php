<?php

class dataModal extends App {

    public function save($table, $data = []) {
        $conn = App::get('database')->insertAll($table, "'" . implode("','", $data) . "'");
        $this->log($table, "insert");
        return $conn;
    }

    public function savedb($query) {
        $conn = App::get('database')->insertAllE($query);
        return $conn;
    }

    public function display($table) {
        $result = App::get('database')->selectAll($table);
        return $result;
    }

    public function displaySum($fields, $tables) {
        return App::get('database')->selectSpecific($fields, $tables);
    }

    public function update($table, $values, $condition) {
        $result = App::get('database')->updateAll($table, $values, $condition);
        $this->log($table, "update");
        return $result;
    }

    public function delete($table, $id) {
        $result = App::get('database')->deleteAll($table, $id);
        $this->log($table, "delete");
        return $result;
    }

    public function log($page, $action) {
//        $table = "log";
//
//        $dt = new DateTime("now", new DateTimeZone('Asia/colombo'));
//        $date = $dt->format('Y-m-d');
//        $time = $dt->format('H:i:s');
//
//        $query = "'" . $time . "','" . $date . "','" . $action . "','" . $page . "','" . $_SESSION['logusersid'] . "','" . $_SESSION['logbrchid'] . "'";
//        $conn = App::get('database')->insertAll($table, $query);
    }

}
