// class Course.php
<?php
require_once 'Database.php';

class Course {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    
    public function addCourse($title, $category_id, $teacher_id) {
        $sql = "INSERT INTO courses (title, category_id, teacher_id) VALUES (:title, :category_id, :teacher_id)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':teacher_id', $teacher_id);
        return $stmt->execute();
    }

    public function getAllCourses() {
        $sql = "SELECT * FROM courses";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
