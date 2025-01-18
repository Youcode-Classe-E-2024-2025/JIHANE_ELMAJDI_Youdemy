<?php
class Login {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Vérifier si les informations de connexion sont valides
    public function validateLogin($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Si l'utilisateur existe
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Démarrer la session et stocker les informations de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['role_id'] = $user['role_id'];
                return true;
            }
        }
        return false;
    }
}
?>
