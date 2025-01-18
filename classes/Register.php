<?php
class Register {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    
    public function emailExists($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function registerUser($name, $email, $password) {
       
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $roleId = 3; 

        $query = "INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, :role_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $roleId);
        return $stmt->execute();
    }
}
?>
