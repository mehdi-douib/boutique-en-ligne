<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<header>
    <?php include 'include/header.php'?>
</header>
<body>
<center>
<form id="login-form" class="container" method="post">
    <h2>Connexion</h2><br>
    <div>
        <label for="email">Adresse email:</label>
        <input type="email" id="email" name="email" placeholder="Entre ton email" required>
    </div>
    <div>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" placeholder="Entre ton password" required>
    </div>
    <div><br>
        <button class="bouton-bleu" type="submit">Se connecter</button>
    </div>
</form>
<div id="error-message"></div>
</center>
</body>

<footer>
    <?php include 'include/footer.php'?>
</footer>
</html>

<?php
// Informations de connexion à la base de données
$dbhost = 'localhost'; // Nom de l'hôte de la base de données
$dbname = 'boutique'; // Nom de la base de données
$dbuser = 'utilisateur'; // Nom d'utilisateur pour se connecter à la base de données
$dbpass = 'mot_de_passe'; // Mot de passe pour se connecter à la base de données

try {
  // Création d'une nouvelle instance de la classe PDO pour se connecter à la base de données
  $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  // Configuration de l'attribut ERRMODE pour afficher les erreurs
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  // En cas d'erreur de connexion, afficher un message d'erreur et arrêter l'exécution du script
  echo 'Erreur de connexion : ' . $e->getMessage();
  exit;
}

// Récupération des informations de connexion envoyées par le formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Préparation de la requête SQL pour récupérer l'utilisateur correspondant à l'adresse email fournie
$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
// Exécution de la requête SQL en passant l'adresse email comme paramètre
$stmt->execute([$email]);

// Récupération de la première ligne du résultat de la requête SQL
$user = $stmt->fetch();

// Vérification que l'utilisateur existe et que le mot de passe fourni correspond au mot de passe stocké (haché) dans la base de données
if ($user && password_verify($password, $user['mot_de_passe'])) {
  // Si l'utilisateur existe et que le mot de passe est correct, renvoyer une réponse JSON indiquant le succès de la connexion
  $response = ['success' => true];
  echo json_encode($response);
} else {
  // Sinon, renvoyer une réponse JSON indiquant l'échec de la connexion et un message d'erreur
  $response = ['success' => false, 'message' => 'Email ou mot de passe incorrect'];
  echo json_encode($response);
}
?>
