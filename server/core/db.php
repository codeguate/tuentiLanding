<?php
require 'config.php';

function db() {
    global $dbConfig, $configGroup;
    static $db = null;
    $dbhost = $dbConfig[$configGroup]['dbhost'];
    $dbname = $dbConfig[$configGroup]['dbname'];


    if (null === $db) {
        try {

            $db = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbConfig[$configGroup]['dbuser'],$dbConfig[$configGroup]['dbpwd'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET time_zone = \'-06:00\''));
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }  catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
    return $db;
}

function callsp($sp, $parameterNames, $data) {
    $parameters = array();
    $stmtString = "CALL " . $sp . "(";
    $counter = 0;
    foreach ($parameterNames as $parameterName) {
        $parameters[] = $data[$parameterName];
        $stmtString .= $counter == 0 ? '?' : ',?';
        $counter++;
    }

    $stmtString .= ");";

    $database = db();

    $stmt = $database->prepare($stmtString);
    $stmt->execute($parameters);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function select($table, $where = '', $whereParameters = array(), $fields = '*') {
    $stmtString = 'SELECT ' . $fields . ' FROM ' . $table;
    if ($where !== '') {
        $stmtString .= ' WHERE ' . $where;
    }
    $database = db();

    $stmt = $database->prepare($stmtString);
    $stmt->execute($whereParameters);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function delete($table, $where = '', $whereParameters = array()) {
    $stmtString = 'DELETE FROM '. $table;
    if ($where !== '') {
        $stmtString .= ' WHERE ' . $where;
    }
    $database = db();

    $stmt = $database->prepare($stmtString);
    $stmt->execute($whereParameters);
}

function callspNoResult($sp, $parameterNames, $data) {
    $parameters = array();
    $stmtString = "CALL " . $sp . "(";
    $counter = 0;
    foreach ($parameterNames as $parameterName) {
        $parameters[] = $data[$parameterName];
        $stmtString .= $counter == 0 ? '?' : ',?';
        $counter++;
    }

    $stmtString .= ");";

    $database = db();

    $stmt = $database->prepare($stmtString);
    $stmt->execute($parameters);
}
function executeQuery($query) {

    $database = db();
    $database->exec($query);
}

?>