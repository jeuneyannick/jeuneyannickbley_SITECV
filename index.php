<?php
require_once('admin/init/connect.php'); // Connexion à ma base de données
require_once('Contact.class.php');
$req = $pdo->query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '1'");
$affiche_utilisateurs = $req -> fetchAll(PDO::FETCH_ASSOC);

$req= $pdo->prepare("SELECT * FROM t_formations  WHERE utilisateur_id= '1' ORDER BY id_formation DESC");
$req->execute();
$affiche_formations = $req-> fetchAll(PDO::FETCH_ASSOC);

$req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '1' ORDER BY id_experience DESC");
$req->execute();
$affiche_experiences= $req-> fetchAll(PDO::FETCH_ASSOC);


$req= $pdo->prepare("SELECT * FROM t_competences WHERE utilisateur_id= '1'");
$req->execute();
$affiche_competences = $req-> fetchAll(PDO::FETCH_ASSOC);

// on vérifie que le formulaire a été posté
if (!empty($_POST)) {// on éclate le tableau avec la methode extract(), ce qui nous permet d'accèder aux champs par des variables
   extract($_POST);
   $valid = (empty($c_nom) || empty($c_email) || !filter_var($c_email, FILTER_VALIDATE_EMAIL) || empty($c_sujet) || empty($c_message))
   ? false : true;// écriture ternaire if else
   $c_nom = htmlspecialchars($c_nom);
   $c_email = htmlspecialchars($c_email);
   $c_sujet = htmlspecialchars($c_sujet);
   $c_message = htmlspecialchars($c_message);


   if ($valid) {// si tous les champs sont renseignés
       $contact = new Contact();// on crée un nouvel objet (ou instance ) de la class Contact.class.phpinfo
       $contact->insertContact($c_nom, $c_email, $c_sujet, $c_message);
       unset($c_nom);
       unset($c_email);
       unset($c_sujet);
       unset($c_message);
   }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_responsive.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous&Roboto" rel="stylesheet">
    <title>Site cv Yannick Bley</title>
</head>
<body>

    <!--Page d'accueil -->
    <section class="first container" id="Accueil">
        <header>
            <div class="container">
                <div class="row">
                    <nav class="text-center navbar navbar-inverse col-xs-4 col-sm-10 col-sm-push-2 col-lg-7 col-lg-push-3">
                        <ul class="nav navbar-nav ">
                            <li><a href="#Accueil">Accueil</a></li>
                            <li><a href="#Competences">Compétences</a></li>
                            <li><a href="#Formations">Formations</a></li>
                            <li><a href="#Experiences">Expériences</a></li>
                            <li><a href="#Contact">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header><!-- Fin du menu !-->
        <!-- Le menu de navigation -->


        <!--Section de présentation du site -->
        <section class="jumbotron col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-xs-12" >
            <div class="container">
                <div class="row">
                    <div class="presentation text-center col-xs-12 col-sm-10 col-sm-offset-1">
                        <h2>Site CV de Yannick Bley</h2>
                        <h3>Développeur Web Junior</h3>
                        <p>Actuellement à la recherche d'une entreprise en alternance</p>
                        <div class="icons">
                            <a href="https://fr.linkedin.com/in/yannick-bley-84b585145"><i class="fa fa-linkedin fa-4x" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/yannick.bley.50"><i class="fa fa-facebook fa-4x" aria-hidden="true"></i></a>
                            <a href="https://github.com/jeuneyannick"><i class="fa fa-github fa-4x" aria-hidden="true"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </section><!--Fin de la section !-->

    </section><!-- Fin de la page d'accueil -->


    <section class="second container" id="Competences"> <!-- Début page Competences -->
        <div class="row">
            <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
                <h2>Compétences</h2>
            </div>
        </div>


        <div class="container-fluid jumbotron">
            <div class="row">
                <div class="competence col-lg-8 col-lg-push-2 col-md-4 col-sm-4 col-sm-push-4 col-xs-12">
                    <?php foreach($affiche_competences as $competence){?>
                        <div class=" col-lg-5 col-md-5 col-sm-5 col-xs-5"><p> <?= $competence['competence']?></p></div>
                        <div class="progress col lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?= $competence['c_niveau']?>% ">
                                <?= $competence['c_niveau']?>
                            </div>
                        </div>
                        <!-- <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"> <?= $competence['c_niveau']?></div> -->

                    <?php } ?>
                </div>
            </div>
        </div>
    </section><!--Fin de la page Compétences -->


    <div class="clearfix"></div>

    <section class="fourth container" id="Formations"><!-- Début de la page Formations -->
        <div class="row">
            <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
                <h2>Formations</h2>
            </div>
        </div>
        <section class="container-fluid jumbotron text-center">
            <div class="row">
                <div class="col-lg-8 col-lg-push-2 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                    <?php foreach($affiche_formations as $form){?>
                        <div class="text-center  col-md-3 col-sm-3 col-xs-12 affiche " ><p class="affiche02"><?= $form['f_titre']?></p></div>
                        <div class="text-center  col-md-3 col-sm-3 col-xs-12 affiche"><p> <?= $form['f_lieu']?></p></div>
                        <div class="text-center  col-md-3 col-sm-3 col-xs-12 affiche " ><p> <?= $form['f_dates']?></p></div>
                        <div class="text-center  col-md-3 col-sm-3 col-xs-12 affiche " ><?= $form['f_description']?></div>
                    <?php } ?>
                </div>
            </div>
        </section>

</section><!-- Fin de la page Formations -->

<div class="clearfix"></div>

<section class="fourth container" id="Experiences"><!-- Début de la page Experiences -->
    <div class="row">
        <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
            <h2>Expériences</h2>
        </div>
    </div>
    <section class="container-fluid jumbotron text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2 col-md-10 col-md-push-1 col-sm-12 col-xs-12">
                <?php foreach($affiche_experiences as $exp){?>
                    <div class="text-center col-lg-3 col-md-3 col-sm-3 col-xs-12 affiche" ><p class="affiche02"><?= $exp['e_poste']?></p></div>
                    <div class="text-center col-lg-3 col-md-3 col-sm-3 col-xs-12 affiche"><p> <?= $exp['e_lieu']?></p></div>
                    <div class="text-center col-lg-3 col-md-3 col-sm-3 col-xs-12 affiche" ><p> <?= $exp['e_dates']?></p></div>
                    <div class="text-center col-lg-3 col-md-3 col-sm-3 col-xs-12 affiche"><?= $exp['e_description']?></div>
                <?php } ?>
            </div>
        </div>
    </section>

</section><!-- Fin de la page Expériences -->

<div class="clearfix"></div><!-- -->

<section class="fifth container" id="Contact"><!-- Début de la page Experiences -->
    <div class="row">
        <div class="page-header text-center col-lg-6 col-lg-push-3 col-sm-6 col-sm-push-3 col-md-6 col-md-push-3 col-xs-12">
            <h2>Contact</h2>
        </div>
    </div>
    <section class="container-fluid jumbotron text-center">
        <div class="row">
            <div class ="col-lg-6 col-lg-push-3">
                <form method="POST">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" name="c_nom" id="nom" placeholder = "Entrez votre nom" required>
                        <span id="aideNom"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" class="form-control" name="c_email" id="email" placeholder = "Entrez une adresse mail valide" required>
                        <span id="aideEmail"></span>
                    </div>
                    <div class="form-group">
                        <label for="sujet">Sujet:</label>
                        <input type="text" class="form-control" name="c_sujet" id="sujet" placeholder="Objet de votre message" required>
                        <span id="aideSujet"></span>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" rows="5" name="c_message" id="message" placeholder ="Laissez un message"></textarea>
                        <span id="aideMessage"></span>
                    </div>
                    <button type="submit" class="btn btn-default largeur">Envoyer</button>
                </form>
            </div>


</section>

</section><!-- Fin de la page Expériences -->

<footer class="text-center">
    <p> <?= date('Y'); ?> -  Tous droits reservés</p>
</footer>

    
</body>
</html>

<script src ="js/main.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
