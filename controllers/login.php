<?php
// Inclure les fichiers nécessaires
include_once '../config/db.php';
include_once '../classes/Login.php';

$message = ''; // Pour afficher les messages de connexion

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créer une instance de la classe Login
    $login = new Login($db);

    // Vérifier si les informations de connexion sont valides
    if ($login->validateLogin($email, $password)) {
        $message = "<div class='alert success'>Connexion réussie !</div>";
        // Rediriger vers la page d'accueil ou le tableau de bord
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "<div class='alert error'>Email ou mot de passe incorrect.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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

        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 25px 35px;
            width: 400px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            letter-spacing: 1px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            position: relative;
            width: 100%;
        }

        label {
            position: absolute;
            top: 10px;
            left: 12px;
            font-size: 14px;
            color: #aaa;
            background: white;
            padding: 0 5px;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        input {
            width: 100%;
            padding: 15px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: none;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 8px rgba(108, 99, 255, 0.5);
        }

        input:focus + label, 
        input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #6c63ff;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #ff6f91, #6c63ff);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(108, 99, 255, 0.5);
            background: linear-gradient(90deg, #6c63ff, #ff6f91);
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
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
            color: transparent;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php echo $message; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder=" " required>
                <label for="email">Adresse Email</label>
            </div>

            <div class="form-group">
                <input type="password" id="password" name="password" placeholder=" " required>
                <label for="password">Mot de passe</label>
            </div>

            <button type="submit" name="login">Se connecter</button>
        </form>
    </div>
</body>
</html>
