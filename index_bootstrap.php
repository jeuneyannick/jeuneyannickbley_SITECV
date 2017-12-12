<?php
require_once('admin/init/connect.php'); // Connexion à ma base de données
require_once('admin/init/functions.php');// Require des fonctions que je vais utiliser
$req = $pdo->query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '1'");
$affiche_utilisateurs = $req -> fetchAll(PDO::FETCH_ASSOC);

$req= $pdo->prepare("SELECT * FROM t_formations WHERE utilisateur_id= '1'");
$req->execute();
$affiche_formations = $req-> fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_formations) . '</br>';

$req= $pdo->prepare("SELECT * FROM t_realisations WHERE utilisateur_id= '1'");
$req->execute();
$affiche_realisations = $req-> fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_realisations) . '</br>';

$req= $pdo->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id= '1'");
$req->execute();
$affiche_loisirs = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_loisirs) . '</br>';

$req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '1'");
$req->execute();
$affiche_experiences= $req-> fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_experiences) . '</br>';

$req= $pdo->prepare("SELECT * FROM t_competences WHERE utilisateur_id= '1'");
$req->execute();
$affiche_competences = $req-> fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_competences) . '</br>';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_front.css">
    <link rel="stylesheet" href="../font-awesome/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <title>Site cv Yannick Bley</title>
</head>
<body>
    <section class="mastehead col-lg-12">
        <nav class="navbar navbar-default navbar fixed-top">
            <div class="container">
                <div class=" text-center col-xs-12 col-md-6">
                    <ul class="nav navbar-nav">
                        <li><a href="#index_bootstrap.php"><p>Accueil</p></a></li>
                        <li><a href="competences"><p>Compétences</p></a></li>
                        <li><a href="#Formations"><p>Formations</p></a></li>
                        <li><a href="#Contact"><p>Contact</p></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="jumbotron text-uppercase col-md-12 col-sm-8">
                    <div class="intro"> Hey Bienvenue sur le site de Yannick Bley !</div>
                    <div class="description">Developpeur/Integrateur Web Junior</div>
                    <div class="search">Je suis actuellement à la recherche d'un stage</div>
                    <div class="btn btn-danger col-md-2 col-md-offset-4 col-sm-2">
                        Suivez moi
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <section class="container">
<div class="row">
<div class="panel panel-default col-md-4">
<button class="btn btn-danger">Competences</button>
<div class="panel-body">
<?php
for($i = 0; $i <count($affiche_competences); $i++){
echo $affiche_competences[$i]['c_niveau'].'</br>';
echo $affiche_competences[$i]['competence'].'</br>';
} ?>
</div>

</div>
<div class="panel panel-default col-md-4">
<button class="btn btn-danger">Formations</button>

<div class="jumbotron text-uppercase col-md-12 col-xs-12">
<?php
for($i = 0; $i <count($affiche_formations); $i++){
echo $affiche_formations[$i]['f_titre'].'</br>';
echo $affiche_formations[$i]['f_soustitre'].'</br>';
echo $affiche_formations[$i]['f_dates'].'</br>';
echo $affiche_formations[$i]['f_description'].'</br>';
} ?>
</div>
</div>
</div>
<div class="row">
<div class="panel panel-default col-md-4">
<button class="btn btn-danger">Experiences</button>
<div class="panel-body">
<?php
for($i = 0; $i <count($affiche_experiences); $i++){
echo $affiche_experiences[$i]['e_titre'].'</br>';
echo $affiche_experiences[$i]['e_soustitre'].'</br>';
echo $affiche_experiences[$i]['e_dates'].'</br>';
echo $affiche_experiences[$i]['e_description'].'</br>';
} ?>
</div>
</div>
<div class="panel panel-default col-md-4">
<button class="btn btn-danger">
Loisirs
</button>
<div class="panel-body">
<?php
for($i = 0; $i <count($affiche_loisirs); $i++){
echo $affiche_loisirs[$i]['loisir'].'</br>';
} ?>
</div>
</div>
</div>
</section> -->
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
</body>
</html>
