<?php
require_once 'Database.php';
require_once 'Authentication.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $auth = new Authentication();
        
        // Récupérer les données du formulaire
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role_id = isset($_POST['role_id']) ? (int)$_POST['role_id'] : 3; // 3 = student par défaut
        
        // Validation supplémentaire
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            throw new Exception("Tous les champs sont obligatoires");
        }
        
        if ($password !== $confirm_password) {
            throw new Exception("Les mots de passe ne correspondent pas");
        }
        
        if (strlen($password) < 8) {
            throw new Exception("Le mot de passe doit contenir au moins 8 caractères");
        }
        
        // Enregistrer l'utilisateur
        if ($auth->register($username, $email, $password, $role_id)) {
            // Connecter l'utilisateur automatiquement
            $auth->login($email, $password);
            
            // Rediriger selon le rôle
            switch($_SESSION['role']) {
                case 'admin':
                    header('Location: admin/dashboard.php');
                    break;
                case 'teacher':
                    header('Location: teacher/dashboard.php');
                    break;
                default:
                    header('Location: student/dashboard.php');
            }
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Youdemy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Inscription</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <small class="text-muted">Minimum 8 caractères</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="role" class="form-label">Je suis un</label>
                                <select class="form-select" id="role" name="role_id">
                                    <option value="3">Étudiant</option>
                                    <option value="2">Enseignant</option>
                                </select>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Déjà inscrit? <a href="login.php">Connectez-vous</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>