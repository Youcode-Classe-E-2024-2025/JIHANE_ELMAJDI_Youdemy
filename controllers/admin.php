<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est admin
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    // Si ce n'est pas un admin, l'accès est refusé
    echo "Accès refusé. Vous devez être un admin pour accéder à cette page.";
    exit;
}

// Code pour afficher la page admin si l'utilisateur est un admin
echo "Bienvenue Admin! Vous êtes maintenant dans la page d'administration.";
?>
