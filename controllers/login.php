<?php
// Inclure les fichiers nécessaires
include_once '../config/db.php';
include_once '../classes/Login.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de la classe Login
    $login = new Login($db);

    // Vérifier si les informations de connexion sont valides
    if ($login->validateLogin($email, $password)) {
        echo "Connexion réussie!";
        // Rediriger vers la page d'accueil ou le tableau de bord
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<!-- Formulaire HTML pour la connexion -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="login.php" method="POST">
            <label for="email">Adresse Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Se connecter</button>
        </form>
    </div>
</body>
</html>
