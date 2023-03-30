<?php
session_start();
?>
<?php
//cone// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

// Récupération des données du formulaire
$nom_utilisateur = $_POST['nom_utilisateur'];
$mot_de_passe = $_POST['mot_de_passe'];
$email_utilisateur = $_POST['email_utilisateur'];
$adresse_livraison = $_POST['adresse_livraison'];
$adresse_facturation = $_POST['adresse_facturation'];

// Vérification si l'utilisateur existe déjà
$sql = "SELECT id_utilisateur FROM Utilisateru WHERE nom_utilisateur = '$nom_utilisateur'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rponse_array['status'] = 'error';
    $rponse_array['message'] 'Ce nom d\'utilisateur est déjà pris.';
    echo json_encode($rponse_array);
    exit();
}

// Insertion des données dans la base de données
$sql = "INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email_utilisateur, adresse_livraison, adresse_facturation) VALUES ('$nom_utilisateur', '$mot_de_passe', '$email_utilisateur', '$adresse_liv