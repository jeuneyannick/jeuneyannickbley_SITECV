<?php
require_once('admin/init/connect.php'); // Connexion à ma base de données
require_once('admin/init/functions.php');// Require des fonctions que je vais utiliser
$req = $pdo->query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '1'");
$affiche_utilisateurs = $req -> fetchAll(PDO::FETCH_ASSOC);

$req= $pdo->prepare("SELECT * FROM t_formations WHERE utilisateur_id= '1'");
$req->execute();
$affiche_formations = $req-> fetchAll(PDO::FETCH_ASSOC);
// var_dump($affiche_formations) . '</br>';

// $req= $pdo->prepare("SELECT * FROM t_realisations WHERE utilisateur_id= '1'");
// $req->execute();
// $affiche_realisations = $req-> fetchAll(PDO::FETCH_ASSOC);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_responsive.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <title>Site cv Yannick Bley</title>
</head>
<body>
    <!--Page d'accueil -->
    <div class="first container">

        <!-- Le menu de navigation -->
        <header class="container">
            <div class="row">
                <nav class="text-center navbar navbar-inverse col-xs-12 col-sm-10 col-lg-7 col-lg-push-3" style="background: #eee;">
                    <ul class=" nav navbar-nav list-inline" style="text-align: center; padding-top:2px; ">
                        <li><a href="#Exo_bootstrap.html">Accueil</a></li>
                        <li><a href="#Competences">Compétences</a></li>
                        <li><a href="#Formations">Formations</a></li>
                        <li><a href="#Experiences">Expériences</a></li>
                        <li><a href="#Realisations">Réalisations</a></li>
                        <li><a href="#Contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <!-- Fin du menu !-->

        <!--Section de présentation du site -->
        <section class="jumbotron col-lg-7 col-sm-7 col-xs-12 ">
            <div class="container">
                <div class="row">
                    <div class="text-center uppercase col-xs-12 col-sm-10 col-sm-offset-1">
                        <h2>Site CV de Yannick Bley</h2>
                        <strong>Developpeur/Integrateur Web Junior</strong>
                        <h3>Actuellement à la recherche d'un stage de 2 mois</h3>

                        <i class="fa fa-linkedin fa-4x" aria-hidden="true"></i>
                        <i class="fa fa-twitter fa-4x" aria-hidden="true"></i>
                        <i class="fa fa-facebook fa-4x" aria-hidden="true"></i>
                        <i class="fa fa-github fa-4x" aria-hidden="true"></i>


                    </div>
                </div>
            </div>


        </section>
        <!--Fin de la section !-->
        <!-- Section à propos -->
        <section class="panel panel-default col-lg-4 col-lg-offset-1 col-sm-4 col-sm-offset-1 col-xs-12">
            <div class="panel panel-heading">
                <h3>Je me présente</h3>
            </div>
            <div class="panel panel-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>

        </section>
        <!--Fin de la section -->
    </div>
    <!-- Fin de la page d'accueil -->

    <!--Début page Compétences -->
    <div class="second container" id="Competences">

        <div class="row">
            <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
                <strong>Compétences</strong>
            </div>
        </div>
        <div class="container jumbotron">
            <div class="row">
                <div class="competence col-lg-4 col-lg-push-4 col-md-4 col-md-push-4 col-sm-4 col-sm-push-4 col-xs-12">
                    <p class="text-center">Competences</p>
                    <?php foreach($affiche_competences as $competence){?>
                        <div class="col-lg-3 col-md-3 col-sm-5 col-xs-12"> <?= $competence['competence']?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Fin de la page Compétences -->

<div class="clearfix">
</div>
<!-- Début de la page Formations -->
<div class="third container" id="Formations">
    <div class="row">

        <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
            <strong>Formations</strong>
        </div>

    </div>

    <div class="row text-center">
        <div class="col-lg-3 col-lg-push-1 col-md-3 col-md-push-1 col-sm-3 col-sm-push-1 col-xs-12">
            <div class="cadre" style=" width: 300px; height: 300px; border-radius: 200px; background:indianred;">
                <div class="icons text-center">
                    <i class="fa fa-graduation-cap fa-4x text-center" aria-hidden="true"></i>
                </div>
                <div class="description">
                    <p>Baccalauréat Série littéraire</p>
                    <p>Lycée Michel-Ange,Villeneuve-la-Garenne</p>
                    <p>2008-2009</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de la page Formations -->

<div class="fourth container" id="Experiences">
    <div class="row">
        <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
            <strong>Expériences</strong>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-lg-push-1  col-md-3 col-md-push-1  col-sm-3 col-sm-push-1  col-xs-12">
                <div class="cadre text-center" style=" width: 200px; height: 200px; border-radius: 100px; background:indianred;">
                    <div class="icons text-center">
                        <i class="fa fa-graduation-cap fa-4x text-center" aria-hidden="true"></i>
                    </div>
                    <div class="description">
                        <p>Baccalauréat Série littéraire</p>
                        <p>Lycée Michel-Ange,Villeneuve-la-Garenne</p>
                        <p>2008-2009</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-lg-push-2 col-md-3 col-lg-push-1  col-sm-3 col-sm-push-1  col-xs-12">
                <div class="cadre text-center" style=" width: 200px; height: 200px; border-radius: 100px; background:indianred;">
                    <div class="icons text-center">
                        <i class="fa fa-graduation-cap fa-4x text-center" aria-hidden="true"></i>
                    </div>
                    <div class="description">
                        <p>Baccalauréat Série littéraire</p>
                        <p>Lycée Michel-Ange,Villeneuve-la-Garenne</p>
                        <p>2008-2009</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-lg-push-2 col-md-3 col-md-push-1 col-sm-3 col-sm-push-1  col-xs-12">
                <div class="cadre text-center" style=" width: 200px; height: 200px; border-radius: 100px; background:indianred;">
                    <div class="icons text-center">
                        <i class="fa fa-graduation-cap fa-4x text-center" aria-hidden="true"></i>
                    </div>
                    <div class="description">
                        <p>Baccalauréat Série littéraire</p>
                        <p>Lycée Michel-Ange,Villeneuve-la-Garenne</p>
                        <p>2008-2009</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- <div class="fifth container" id="Realisations">
<div class="row">
<div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
<strong>Réalisations</strong>
</div>
</div>

<div class="row">
<div class="col-lg-4 col-lg-push-1 col-md-4 col-md-push-1 col-sm-4 col-sm-push-1">
<div class="thumbnail text-center">
<img src="" alt="chamyl">
<div class="caption">
<h3>Thumbnail label</h3>
</div>
</div>
</div>
</div>

</div> -->

<footer class="text-center">
    <p>Tous droits reservés</p>
</footer>





<script src="admin/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="admin/js/jquery-3.2.1.min.js"></script>
<script src="admin/js/mobilefirst.js"></script>
</body>
