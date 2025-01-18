<?php
class Login {
    private $db;
    private $email;
    private $password;

    public function __construct($db, $email, $password) {
        $this->db = $db;
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser() {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->email]);
        $user = $stmt->fetch();
        if ($user && password_verify($this->password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>