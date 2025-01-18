<?php
class Register {
    private $db;
    private $name;
    private $email;
    private $password;
    private $role;

    public function __construct($db, $name, $email, $password, $role) {
        $this->db = $db;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function registerUser() {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$this->name, $this->email, $hashedPassword, $this->role]);
    }
}
?>