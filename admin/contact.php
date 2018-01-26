<?php
// gestion des contenus de la bdd
//suppression d'une competence
require_once('init/connect.php');

session_start();// à mettre dans toutes les pages de l'admin
if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom= $_SESSION['nom'];

}else{ // l'utilisateur  n'est pas connecté
    header('location:connexion.php');
}

$req = $pdo->prepare("SELECT * FROM t_contact ORDER BY id_contact DESC");
// $ligne_commentaires = $sql->fetch();
$req->execute();
$nbr_commentaires = $req->rowCount();


if(isset($_GET['id_contact'])) { // on récupère le loisir. par son id dans l'url
    $efface = $_GET['id_contact']; //  je mets cela dans une variable
    $reqDelete = (" DELETE FROM t_contact WHERE id_contact = '$efface'");
    $pdo->query($reqDelete); // on peut avec exec aussi si on veut
    header('location:contact.php'); // pour revenir sur la page
    exit();
} // ferme le if isset
