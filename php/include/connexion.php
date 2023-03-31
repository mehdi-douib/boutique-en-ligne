<?php
require './php/fonctions/fonctions.php';
$pdo = connexionPDO();

// Requête pour récupérer tous les utilisateurs
$sql = "SELECT * FROM Utilisateurs";
$stmt = $pdo->query($sql);
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fermeture de la connexion
$pdo = null;
?>