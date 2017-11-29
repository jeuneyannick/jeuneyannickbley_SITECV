<?php
require_once('init/connect.php');
session_start(); // à mettre dabs toutes les pages de l'admin (même cette page)
$msg_authentification ='';//On initialise la variable en cas d'erreur
// pour déconnecter de l'admin
if(isset($_GET['quitter']) && $_GET['quitter']=='oui'){// on récupère le terme quitter dans l'url
    $_SESSION['connexion']=''; // on vide les variables de session
    $_SESSION['id_utilisateur']='';
    $_SESSION['prenom']='';
    $_SESSION['nom']='';

    unset($_SESSION['connexion']);
    session_destroy();
    header('location:connexion.php');
} // ferme le isset de la déconnexion

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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_connexion.css">
    <link href="https://fonts.googleapis.com/css?family=Magra" rel="stylesheet">

</head>
<body>
    <div class="container" id="authentify">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="alert alert-info" role="alert">
                    <h1>Admin: s'authentifier</h1>
                </div>
            </div>
        </div>
    </div>
    <!--Formulaire de connexion à l'admin -->
    <div class="container">
        <div class="jumbotron">
            <form action="connexion.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Courriel</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" placeholder="Votre courriel"required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mdp" class="col-sm-2 control-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" name="mdp" placeholder="Votre mot de passe"required class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button name="connexion" type="submit" class="btn btn-default" >Connexion à votre admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
