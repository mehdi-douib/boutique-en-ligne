<?php
session_start();

// Informations de connexion à la base de données
$host = "localhost"; // le nom de l'hôte de la base de données
$username = "root"; // le nom d'utilisateur pour la base de données
$password = ""; // le mot de passe de l'utilisateur pour la base de données
$dbname = "boutique"; // le nom de la base de données

// Connexion à la base de données
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}
?>