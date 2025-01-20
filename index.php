<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <style>
        /* Style global */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffccf9, #cce7ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Conteneur principal */
        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px 50px;
            width: 80%;
            max-width: 800px;
            text-align: center;
        }

        /* Titre */
        h1 {
            color: #333;
            font-size: 36px;
            margin-bottom: 20px;
        }

        /* Message d'accueil */
        p {
            font-size: 18px;
            color: #555;
        }

        /* Boutons */
        .btn {
            padding: 12px 30px;
            background: linear-gradient(90deg, #ff6f91, #6c63ff);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: linear-gradient(90deg, #6c63ff, #ff6f91);
        }

        /* Liens de navigation */
        .nav {
            margin-top: 30px;
        }

        .nav a {
            color: #6c63ff;
            font-size: 18px;
            text-decoration: none;
            margin: 0 15px;
        }

        .nav a:hover {
            color: #ff6f91;
        }

        /* Message de déconnexion ou connexion */
        .welcome-message {
            font-size: 20px;
            color: #333;
            margin-top: 30px;
        }

        /* Effet de transition */
        .container {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue sur YouQuiz</h1>
        <p>Un site interactif pour tester vos connaissances et apprendre en s'amusant.</p>

        <!-- Si l'utilisateur est connecté -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="welcome-message">Bienvenue, <?php echo $_SESSION['user_name']; ?> !</p>
            <a href="logout.php" class="btn">Se déconnecter</a>
        <?php else: ?>
            <p>Vous n'êtes pas encore inscrit ? Rejoignez-nous maintenant !</p>
            <a href="register.php" class="btn">S'inscrire</a>
            <a href="login.php" class="btn">Se connecter</a>
        <?php endif; ?>

        <div class="nav">
            <a href="about.php">À propos</a>
            <a href="contact.php">Contact</a>
        </div>
    </div>
</body>
</html>
