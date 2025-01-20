<?php

include_once '../config/db.php';
include_once '../classes/Register.php';

$message = ''; // Pour afficher les messages d'inscription

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $roleId = $_POST['role_id'];  

    if ($password !== $confirm_password) {
        $message = "<div class='alert error'>Les mots de passe ne correspondent pas.</div>";
        exit;
    }

    $register = new Register($db);

    if ($register->emailExists($email)) {
        $message = "<div class='alert error'>Cet email est déjà utilisé.</div>";
        exit;
    }

    if ($register->registerUser($name, $email, $password, $roleId)) { 
        $message = "<div class='alert success'>Inscription réussie!</div>";
        header("Location: login.php");
        exit;
    } else {
        $message = "<div class='alert error'>Erreur lors de l'inscription. Réessayez.</div>";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff77a9, #6c9ae3); /* Dégradé rose et bleu */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 25px 40px;
            width: 380px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        form h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
            text-align: left;
        }

        .input-container {
            position: relative;
            margin-bottom: 15px;
        }

        .input-container input, .input-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-container input:focus, .input-container select:focus {
            outline: none;
            border-color: #6c9ae3;
            box-shadow: 0 0 5px rgba(108, 154, 227, 0.5);
        }

        .input-container i {
            position: absolute;
            right: 10px;
            top: 10px;
            color: #6c9ae3;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff77a9, #6c9ae3);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
            font-size: 16px;
        }

        button:hover {
            background: linear-gradient(90deg, #6c9ae3, #ff77a9);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #6c9ae3;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #ff77a9;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: bold;
            color: white;
        }

        .success {
            background-color: #28a745;
        }

        .error {
            background-color: #dc3545;
        }

        ::placeholder {
            color: #aaa;
        }

    </style>
</head>
<body>
    <form action="register.php" method="POST">
        <h2>Inscription</h2>
        <?php echo $message; ?>
        
        <div class="input-container">
            <label for="name">Nom Complet:</label>
            <input type="text" id="name" name="name" placeholder="Entrez votre nom complet" required>
            <i class="fas fa-user"></i>
        </div>

        <div class="input-container">
            <label for="email">Adresse Email:</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-container">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
            <i class="fas fa-lock"></i>
        </div>

        <div class="input-container">
            <label for="confirm_password">Confirmer le mot de passe:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez le mot de passe" required>
            <i class="fas fa-lock"></i>
        </div>

        <div class="input-container">
            <label for="role">Rôle:</label>
            <select name="role_id" id="role" required>
                <option value="3">Administrateur</option>
                <option value="2">Enseignant</option>
                <option value="1">Etudiant</option>
            </select>
        </div>

        <button type="submit" name="register">S'inscrire</button>
        <p class="login-link">J'ai déjà un compte ? <a href="login.php">Se connecter</a></p>
    </form>

    <!-- Ajouter l'icône de Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
