// class Enrollment.php
<?php
require_once 'Database.php';

class Enrollment {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Inscrire un étudiant dans un cours
    public function enroll($course_id, $user_id) {
        $sql = "INSERT INTO enrollments (course_id, user_id) VALUES (:course_id, :user_id)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Récupérer tous les étudiants inscrits dans un cours
    public function getEnrollments($course_id) {
        $sql = "SELECT * FROM enrollments WHERE course_id = :course_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
