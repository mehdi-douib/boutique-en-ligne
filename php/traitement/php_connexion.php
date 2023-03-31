<?php

session_start();

// Configuration de la connexion à la base de données
$host = 'localhost';
$dbname = 'boutique';
$user = 'root';
$pass = '';

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit;
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour vérifier l'existence de l'utilisateur dans la base de données
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $stmt->execute(['email' => $email, 'password' => $password]);
    $user = $stmt->fetch();

    if ($user) {
        // L'utilisateur existe, on le connecte
        session_start();
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    } else {
        // L'utilisateur n'existe pas ou les informations sont incorrectes
        $errorMessage = "L'adresse email ou le mot de passe est incorrect.";
    }
}
?>


