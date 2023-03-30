<?php
    require 'php/class/class_user.php';
?>

    <?php
     session_start();
     ?>

    <?php
    // Connexion à la base de données
    $host = 'localhost';
    $dbname = 'boutique';
    $user = 'root';
    $password = '';
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
    
    // Requête d'exemple pour récupérer tous les utilisateurs
    $sql = "SELECT * FROM Utilisateurs";
    $stmt = $pdo->query($sql);
    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fermeture de la connexion
    $pdo = null;
    ?>
    