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
    <main>
        <header>
            <nav class="navbar navbar-default navbar fixed-top">
                <div class="container">
                    <div class=" text-center col-xs-12 col-md-12">
                        <ul class="nav navbar-nav">
                            <li><a href="#mobilefirst" id="home"><p>Accueil</p></a></li>
                            <li><a href="#competences" id="competences"><p>Compétences</p></a></li>
                            <li><a href="#Formations" id="formations"><p>Formations</p></a></li>
                            <li><a href="#Experiences" id="experiences"><p>Experiences</p></a></li>
                            <li><a href="#Contact" id="contact"><p>Contact</p></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container contains">
            <div class="row">
                <div class="jumbotron text-uppercase text-center col-xs-12 col-md-12" id="block">


                    <!-- <?php
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
                    } ?> -->

<!--
                    <div class="intro"> Site portfolio de Yannick Bley</div>
                    <div class="description">Developpeur/Integrateur Web Junior</div>
                    <div class="search">Actuellement à la recherche d'un stage</div>
                    <div class="socialnetwork text-center col-md-12 col-xs-5 col-sm-4">
                        <a href="https://fr.linkedin.com/in/yannick-bley-84b585145" target="_blank" title="Ajoutez moi sur Linkedin"><i class="fa fa-linkedin fa-5x " aria-hidden="true"></i></a>
                        <a href="https://twitter.com/YannickBley" target="_blank" title="Suivez moi sur Twitter"><i class="fa fa-twitter fa-5x " aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/yannick.bley.50" target="_blank" title="Ajoutez moi sur Facebook"><i class="fa fa-facebook fa-5x " aria-hidden="true"></i></a>
                        <a href="https://github.com/jeuneyannick" target="_blank" title="Regardez mon GitHub"><i class="fa fa-github fa-5x" aria-hidden="true"></i></a>
                    </div> -->

                </div>
            </div>
        </div>
        <footer>
                <div class="conteneur col-md-2 col-md-offset-5">
                    <?= date('Y') ?> - Tous droits reservés.
                </div>
        </footer>
        <main>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="admin/js/bootstrap.min.js"></script>
            <script src="admin/js/mobilefirst.js"></script>
            <script src="admin/js/jquery-3.2.1.min.js"></script>
        </body>
