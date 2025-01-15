<?php
require_once 'Database.php';

class Authentication {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function register($username, $email, $password, $role_id) {
        try {
            // Validation
            if (empty($username) || empty($email) || empty($password)) {
                throw new Exception("Tous les champs sont obligatoires");
            }
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Format d'email invalide");
            }
            
            // Vérifier si l'email existe déjà
            $stmt = $this->db->execute(
                "SELECT id FROM users WHERE email = ?",
                [$email]
            );
            
            if ($stmt->rowCount() > 0) {
                throw new Exception("Cet email existe déjà");
            }
            
            // Hash le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insérer l'utilisateur
            $stmt = $this->db->execute(
                "INSERT INTO users (username, email, password, role_id, is_active) 
                 VALUES (?, ?, ?, ?, true)",
                [$username, $email, $hashedPassword, $role_id]
            );
            
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function login($email, $password) {
        try {
            // Validation
            if (empty($email) || empty($password)) {
                throw new Exception("Tous les champs sont obligatoires");
            }
            
            // Récupérer l'utilisateur
            $user = $this->db->fetch(
                "SELECT u.*, r.name as role_name 
                 FROM users u 
                 JOIN roles r ON u.role_id = r.id 
                 WHERE u.email = ?",
                [$email]
            );
            
            if (!$user) {
                throw new Exception("Email ou mot de passe incorrect");
            }
            
            // Vérifier le mot de passe
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Email ou mot de passe incorrect");
            }
            
            // Vérifier si le compte est actif
            if (!$user['is_active']) {
                throw new Exception("Votre compte est désactivé");
            }
            
            // Créer la session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role_name'];
            
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        return true;
    }
    
    public function isLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }
    
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        return $this->db->fetch(
            "SELECT u.*, r.name as role_name 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.id = ?",
            [$_SESSION['user_id']]
        );
    }
    
    public function hasRole($role) {
        if (!$this->isLoggedIn()) {
            return false;
        }
        
        return $_SESSION['role'] === $role;
    }
}
?>
