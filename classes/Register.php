// Register.php
<?php
require_once 'classes/Database.php';


class Register {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function registerUser($name, $email, $password, $confirm_password) {
        // Vérifier si les champs sont remplis
        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            return "جميع الحقول ضرورية";
        }

        // Vérifier si les mots de passe correspondent
        if ($password !== $confirm_password) {
            return "كلمة السر غير متطابقة";
        }

        // Vérifier si l'email existe déjà
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            return "البريد الإلكتروني مستعمل من قبل";
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insérer l'utilisateur avec le rôle 'Membre' par défaut
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
        $result = $stmt->execute([$name, $email, $hashedPassword, 'Membre']);

        if ($result) {
            return "تم التسجيل بنجاح";
        } else {
            return "حدث خطأ أثناء التسجيل";
        }
    }
}
?>
