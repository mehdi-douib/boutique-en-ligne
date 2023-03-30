<?php

class UserPDO {
  private $pdo;

  public function __construct($host, $dbname, $username, $password) {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $this->pdo = new PDO($dsn, $username, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function createUser($nom_utilisateur, $mot_de_passe, $email_utilisateur, $adresse_livraison, $adresse_facturation) {
    $stmt = $this->pdo->prepare("INSERT INTO Utilisateurs (nom_utilisateur, mot_de_passe, email_utilisateur, adresse_livraison, adresse_facturation) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom_utilisateur, $mot_de_passe, $email_utilisateur, $adresse_livraison, $adresse_facturation]);
  }

  public function getUserById($id_utilisateur) {
    $stmt = $this->pdo->prepare("SELECT * FROM Utilisateurs WHERE id_utilisateur = ?");
    $stmt->execute([$id_utilisateur]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getUserByEmail($email_utilisateur) {
    $stmt = $this->pdo->prepare("SELECT * FROM Utilisateurs WHERE email_utilisateur = ?");
    $stmt->execute([$email_utilisateur]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updateUser($id_utilisateur, $nom_utilisateur, $mot_de_passe, $email_utilisateur, $adresse_livraison, $adresse_facturation) {
    $stmt = $this->pdo->prepare("UPDATE Utilisateurs SET nom_utilisateur = ?, mot_de_passe = ?, email_utilisateur = ?, adresse_livraison = ?, adresse_facturation = ? WHERE id_utilisateur = ?");
    $stmt->execute([$nom_utilisateur, $mot_de_passe, $email_utilisateur, $adresse_livraison, $adresse_facturation, $id_utilisateur]);
  }

  public function deleteUser($id_utilisateur) {
    $stmt = $this->pdo->prepare("DELETE FROM Utilisateurs WHERE id_utilisateur = ?");
    $stmt->execute([$id_utilisateur]);
  }
}

?>
