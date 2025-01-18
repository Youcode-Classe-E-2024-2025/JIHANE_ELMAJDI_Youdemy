<?php

require_once '../classes/Database.php';

$database = new Database();

$conn = $database->connect();

if ($conn) {
    echo "✅ Connexion réussie à la base de données.";  
} else {
    echo "❌ Échec de la connexion."; 
}
?>
