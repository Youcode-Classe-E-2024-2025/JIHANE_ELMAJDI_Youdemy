<?php
session_start();

// Vérifier si l'utilisateur est un admin (role_id = 3)
if ($_SESSION['role_id'] != 3) {
    echo "Accès refusé. Vous devez être un admin pour accéder à cette page.";
    exit;
}

// Code pour afficher la page admin
echo "Bienvenue Admin! Vous êtes maintenant dans la page d'administration.";
?>
