<?php
require_once('admin/init/connect.php');

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
    <main class="container-fluid col-md-7 col-md-offset-2">
        <nav class="navbar navbar-default navbar fixed-top">
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-md-6 col-md-offset-6">
                        <ul class="nav navbar-nav">
                            <li><a href="#index_bootstrap.php"><p>Accueil</p></a></li>
                            <li><a href="#competences"><p>Compétences</p></a></li>
                            <li><a href="#Formations"><p>Formations</p></a></li>
                            <li><a href="#Contact"><p>Contact</p></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>


        <section class="mastehead col-lg-12">
            <div class="container">
                <div class="row">
                    <div class="jumbotron text-uppercase col-md-offset-2 col-md-7">
                        <div class="intro"> Hey Bienvenue sur le site de Yannick Bley !</div>
                        <div class="description">Developpeur/Integrateur Web Junior</div>
                        <div class="search"> Je suis actuellement à la recherche d'un stage</div>
                        <div class="btn btn-danger col-md-3 col-md-offset-3">
                            Retrouvez moi sur
                        </div>
                    </div>
                </div>
            </div>
            <section class="container">
                <div class="row">
                    <div class="panel panel-default col-md-4">
                        <button class="btn btn-danger">Competences</button>
                    </div>
                    <div class="panel panel-default col-md-4">
                        <button class="btn btn-danger">Formations</button>
                        <div class="panel-body">
                            JavaScript
                            Css
                            html
                            php
                            Bootstrap
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="panel panel-default col-md-4">
                        <button class="btn btn-danger">Experiences</button>
                    </div>
                    <div class="panel panel-default col-md-4">
                        <button class="btn btn-danger">
                            Loisirs
                        </button>
                    </div>
                </div>
            </section>
        </section>
    </main>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
</body>
</html>
