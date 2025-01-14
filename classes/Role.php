// class Role.php
<?php
require_once 'Database.php';

class Role {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Ajouter un rôle pour un utilisateur
    public function assignRole($user_id, $role) {
        $sql = "UPDATE users SET role = :role WHERE id = :user_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Récupérer tous les rôles
    public function getRoles() {
        return ['etudiant', 'enseignant', 'admin'];
    }
}
?>
