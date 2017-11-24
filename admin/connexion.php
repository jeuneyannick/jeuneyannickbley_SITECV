<?php
require_once('init/connect.php');
session_start(); // à mettre dabs toutes les pages de l'admin (même cette page)
  $msg_authentification ='';//On initialise la variable en cas d'erreur

if(isset ($_POST['connexion'])){// On envoie le form avec le name du button (on a cliqué dessus )
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);
    $req = $pdo->prepare("SELECT* FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp'");
    $req->execute();
    $nbr_utilisateurs = $req->rowCount(); // s'il est dans la table on le compte mais O s'il n'y est pas
      if ($nbr_utilisateurs  == 0 ){//il n'est pas ! Diantre !
          $msg_authentification= "Erreur d'authentification !";
      }else{//On le trouve, il est inscrit
          $ligne_utilisateur = $req->fetch(); // On cherche ses infos

          $_SESSION['connexion']= 'connecté';
          $_SESSION['id_utilisateur']= $ligne_utilisateur['id_utilisateur'];
          $_SESSION['prenom']= $ligne_utilisateur['prenom'];
          $_SESSION['nom']= $ligne_utilisateur['nom'];
          header('location: index.php');



      }
}//Ferme le if isset
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentification</title>

</head>
<body>
    <h1>Admin: s'authentifier</h1>
    <hr>

    <!--Formulaire de connexion à l'admin -->

    <form action="connexion.php" method="post">
        <label for="email">Courriel</label>
        <input type="email" name="email" placeholder="Votre courriel"required>
        <br>
        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" placeholder="Votre mot de passe"required>
        <br>
        <button name="connexion" type="submit">Connexion à votre admin</button>
    </form>
</body>
</html>
