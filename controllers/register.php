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
<form action="register.php" method="POST">
    <label for="name">Nom Complet:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Adresse Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirmer le mot de passe:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <label for="role">Rôle:</label>
<select name="role_id" id="role" required>
    <option value="3">Administrateur</option>
    <option value="2">Enseignant</option>
    <option value="1">Etudiant</option>
</select>

    <button type="submit" name="register">S'inscrire</button>
</form>
