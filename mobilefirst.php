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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_responsive.css">
    <link rel="stylesheet" href="font-awesome/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <title>Site cv Yannick Bley</title>
</head>
<body>
    <header>
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
    </header>
    <div class="container">
        <div class="row">
            <div class="jumbotron text-uppercase text-center col-xs-12 col-md-12">
                <div class="intro"> Hey Bienvenue sur le site de Yannick Bley !</div>
                <div class="description">Developpeur/Integrateur Web Junior</div>
                <div class="search">Je suis actuellement à la recherche d'un stage</div>
                <div class=" text-center btn btn-danger col-md-2 col-xs-6">
                    Suivez moi
                </div>
                <ul class="socialnetwork text-center">
                    <li><a href="https://twitter.com/YannickBley"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="https://www.facebook.com/yannick.bley.50"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="https://fr.linkedin.com/in/yannick-bley-84b585145"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href="https://github.com/jeuneyannick"><i class="fa fa-github" aria-hidden="true"></i></a></li>

                </ul>
            </div>
        </div>
    </div>

</body>
