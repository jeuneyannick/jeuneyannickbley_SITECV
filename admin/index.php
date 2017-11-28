<?php
require_once('init/connect.php');

session_start();// à mettre dans toutes les pages de l'admin

if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom= $_SESSION['nom'];

}else{ // l'utilisateur  n'est pas connecté
    header('location:connexion.php');
}


$req = $pdo->query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);

$req= $pdo->prepare("SELECT * FROM t_formations WHERE utilisateur_id= '$id_utilisateur'");
$req->execute();
$nbr_formations = $req-> rowCount();

$req= $pdo->prepare("SELECT * FROM t_realisations WHERE utilisateur_id= '$id_utilisateur'");
$req->execute();
$nbr_realisations = $req-> rowCount();

$req= $pdo->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id= '$id_utilisateur'");
$req->execute();
$nbr_loisirs = $req-> rowCount();

$req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '$id_utilisateur'");
$req->execute();
$nbr_experiences = $req-> rowCount();

$req= $pdo->prepare("SELECT * FROM t_competences WHERE utilisateur_id= '$id_utilisateur'");
$req->execute();
$nbr_competences = $req-> rowCount();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin : <?= $ligne_utilisateur['prenom'] . ' :  ' . $ligne_utilisateur['nom'] ; ?> nom</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_admin.css" rel="stylesheet">
</head>
<body>
    <?php include('inc/nav_inc.php'); ?>

    <div class="container-fluid" id="back">
        <div class="container" id="font">
            <div class="row"><!-- Contenu du premier affichage !-->

                <div class= "col-md-8">

                    <div class="well">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                    </div>

                </div><!--Fin de la div du contenu du premier affichage !-->
            </div>

            <div class="row"><!-- Contenu de la table Utilisateurs !-->
                <div class= "col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <em>Vous avez <?php echo "$nbr_competences";?> compétences</em>
                            <br>
                            <em>Vous avez <?php echo "$nbr_formations" ?> formations</em>
                            <br>
                            <em>Vous avez <?php echo "$nbr_realisations"; ?> réalisations</em>
                            <br>
                            <em>Vous avez <?php echo "$nbr_experiences"; ?> experiences</em>
                            <br>
                            <em>Vous avez <?php echo "$nbr_loisirs"; ?> loisirs</em>
                            <br>

                        </div>
                    </div>
                </div><!--Fin d'affichage  !-->
            </div>
        </div>
    </div>









</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
