<?php

class Database {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    private function exec($request, $values = null) {
        $stmt = $this->db->prepare($request);
        $stmt->execute($values);
        return $stmt;
    }

    public function setFetchMode($fetchMode) {
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetchMode);
    }

    public function execute($request, $values = array()) {
        $result = $this->exec($request, $values);
        return ($result) ? true : false;
    }

    public function fetch($request, $values = null, $all = true) {
        $result = $this->exec($request, $values);
        return ($all) ? $result->fetchAll() : $result->fetch();
    }
}
?>
