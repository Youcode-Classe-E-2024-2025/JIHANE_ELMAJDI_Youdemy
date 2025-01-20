<?php

include_once '../config/db.php';
include_once '../classes/Register.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $roleId = $_POST['role_id'];  

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    $register = new Register($db);

    if ($register->emailExists($email)) {
        echo "Cet email est déjà utilisé.";
        exit;
    }

    if ($register->registerUser($name, $email, $password, $roleId)) { 
        echo "Inscription réussie!";
        header("Location: login.php");
        exit;
    } else {
        echo "Erreur lors de l'inscription. Réessayez.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ffccf9, #cce7ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px 30px;
            width: 350px;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }

        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 5px rgba(108, 99, 255, 0.5);
        }

        button {
            background: linear-gradient(90deg, #ff6f91, #6c63ff);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(90deg, #6c63ff, #ff6f91);
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #ff6f91;
        }

        ::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>
    <form action="register.php" method="POST">
        <h2>Inscription</h2>
        <label for="name">Nom Complet:</label>
        <input type="text" id="name" name="name" placeholder="Entrez votre nom complet" required>

        <label for="email">Adresse Email:</label>
        <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>

        <label for="confirm_password">Confirmer le mot de passe:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez le mot de passe" required>

        <label for="role">Rôle:</label>
        <select name="role_id" id="role" required>
            <option value="3">Administrateur</option>
            <option value="2">Enseignant</option>
            <option value="1">Etudiant</option>
        </select>

        <button type="submit" name="register">S'inscrire</button>
        <p class="login-link">J'ai déjà un compte ? <a href="login.php">Se connecter</a></p>
    </form>
</body>
</html>
