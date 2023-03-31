<?php

session_start();

// Informations de connexion à la base de données
$host = "localhost";
$dbname = "boutique";
$user = "root";
$password = "";

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// Traitement du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $email = $_POST["email"];
    $livraison = $_POST["livraison"];
    $facturation = $_POST["Facturation"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Vérification des champs obligatoires
    if ($login == "" || $email == "" || $livraison == "" || $facturation == "" || $password == "" || $confirmpassword == "") {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    // Vérification de la correspondance des mots de passe
    if ($password != $confirmpassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Vérification de l'existence du login dans la base de données
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        echo "Ce login est déjà utilisé.";
        exit;
    }

    // Insertion de l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, email, livraison, facturation, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$login, $email, $livraison, $facturation, $password]);

    // Redirection vers une page de confirmation
    header("Location: confirmation.php");
    exit;
}
?>
