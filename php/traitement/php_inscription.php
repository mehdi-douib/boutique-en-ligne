<?php    
    include 'php/class/class_user.php';

    session_start();

    <?php
    // Informations de connexion à la base de données
    $servername = "Mariadb";
    $username = "root";
    $password = "";
    $dbname = "boutique";
    
    // Connexion à la base de données
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Définition du mode d'erreur PDO à l'exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion réussie à la base de données";
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
    
    // Récupération des données du formulaire
    $login = $_POST['login'];
    $email = $_POST['email'];
    $livraison = $_POST['livraison'];
    $facturation = $_POST['Facturation'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    // Vérification si les mots de passe sont identiques
    if ($password != $confirmpassword) {
        echo "Les mots de passe ne correspondent pas";
    } else {
        // Hashage du mot de passe pour plus de sécurité
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Préparation de la requête SQL avec une requête préparée
        $stmt = $conn->prepare("INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email_utilisateur, adresse_livraison, adresse_facturation) VALUES (:nom_utilisateur, :mot_de_passe, :email_utilisateur, :adresse_livraison, :adresse_facturation)");
        $stmt->bindParam(':nom_utilisateur', $login);
        $stmt->bindParam(':mot_de_passe', $hashed_password);
        $stmt->bindParam(':email_utilisateur', $email);
        $stmt->bindParam(':adresse_livraison', $livraison);
        $stmt->bindParam(':adresse_facturation', $facturation);
    
        // Exécution de la requête
        try {
            $stmt->execute();
            echo "Inscription réussie";
        } catch(PDOException $e) {
            echo "Erreur d'inscription: " . $e->getMessage();
        }
    }
    
    // Fermeture de la connexion à la base de données
    $conn = null;
    ?>
    