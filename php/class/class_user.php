<?php

class User
{
    private $db;

    public function __construct($host, $db_name, $username, $password)
    {
        $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    public function createUser($nom_utilisateur, $mot_de_passe, $email_utilisateur, $adresse_livraison, $adresse_facturation)
    {
        $stmt = $this->db->prepare("INSERT INTO Utilisateurs(nom_utilisateur, mot_de_passe, email_utilisateur, adresse_livraison, adresse_facturation)
                                        VALUES (:nom_utilisateur, :mot_de_passe, :email_utilisateur, :adresse_livraison, :adresse_facturation)");
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':mot_de_passe', password_hash($mot_de_passe, PASSWORD_DEFAULT));
        $stmt->bindParam(':email_utilisateur', $email_utilisateur);
        $stmt->bindParam(':adresse_livraison', $adresse_livraison);
        $stmt->bindParam(':adresse_facturation', $adresse_facturation);
        $stmt->execute();
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Utilisateurs WHERE id_utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getUserByUsername($nom_utilisateur)
    {
        $stmt = $this->db->prepare("SELECT * FROM Utilisateurs WHERE nom_utilisateur = :nom_utilisateur");
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateUser($id_utilisateur, $nom_utilisateur, $email_utilisateur, $adresse_livraison, $adresse_facturation)
    {
        $stmt = $this->db->prepare("UPDATE Utilisateurs SET nom_utilisateur = :nom_utilisateur, email_utilisateur = :email_utilisateur, adresse_livraison = :adresse_livraison, adresse_facturation = :adresse_facturation WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':email_utilisateur', $email_utilisateur);
        $stmt->bindParam(':adresse_livraison', $adresse_livraison);
        $stmt->bindParam(':adresse_facturation', $adresse_facturation);
        $stmt->execute();
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Utilisateurs WHERE id_utilisateur = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
