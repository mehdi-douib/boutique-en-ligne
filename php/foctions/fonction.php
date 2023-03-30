<?php
function connexionPDO() {
    try {
        $bd = new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root', '');
    } catch (PDOException $e) {
        echo 'Échec de la connexion : ' . $e->getMessage();
        exit;
    }
    return $bd;
}

function recuperation($base,$selection,$table) {
    $requete = $base->prepare("SELECT $selection FROM $table" );
    $requete->execute();
    $resultat = $requete->fetchall();

    return $resultat ;
}

function recuperation_join($base,$table,$table2,$table_join1,$table_join2,$parametre2,$parametre3){
    $requete = $base->prepare("SELECT * FROM $table INNER JOIN $table2 ON $table_join1 = $table_join2 WHERE $parametre2 = ?");
    $requete->execute(array($parametre3));
    $resultat = $requete->fetchall();
    return $resultat;
}

// Exemple d'utilisation des fonctions :

$bdd = connexionPDO();

// Récupération de tous les utilisateurs
$utilisateurs = recuperation($bdd, "*", "Utilisateurs");

// Récupération d'un utilisateur en particulier avec son ID
$id_utilisateur = 1;
$utilisateur = recuperation_join($bdd, "Utilisateurs", "Commandes", "id_utilisateur", "id_utilisateur", "Utilisateurs.id_utilisateur", $id_utilisateur);

// Récupération de tous les produits
$produits = recuperation($bdd, "*", "Produits");

// Récupération de toutes les commandes pour un utilisateur en particulier avec son ID
$id_utilisateur = 1;
$commandes = recuperation_join($bdd, "Commandes", "Utilisateurs", "id_utilisateur", "id_utilisateur", "Commandes.id_utilisateur", $id_utilisateur);

// Récupération de tous les détails de commande pour une commande en particulier avec son ID
$id_commande = 1;
$details_commande = recuperation_join($bdd, "Details_Commande", "Produits", "id_produit", "id_produit", "Details_Commande.id_commande", $id_commande);


?>