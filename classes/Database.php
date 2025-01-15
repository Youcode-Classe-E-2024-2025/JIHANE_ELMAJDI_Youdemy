
<?php
require_once __DIR__ . '/../config/config.php';

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

    public function getConnection() {
        return $this->db;
    }

    public function execute($request, $values = array()) {
      
        $stmt = $this->db->prepare($request);
        $stmt->execute($values);
        return $stmt;
    }

    public function fetch($request, $values = null) {
     
        $stmt = $this->db->prepare($request);
        $stmt->execute($values);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
