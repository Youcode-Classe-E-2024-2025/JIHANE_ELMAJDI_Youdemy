// class Category.php
<?php
require_once 'Database.php';

class Category {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function addCategory($name) {
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
