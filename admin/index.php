<?php
require_once('connexion.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php $req = $pdo -> query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '1'");
    $ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);
    ?>
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
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
                    </div>

                </div><!--Fin de la div du contenu du premier affichage !-->
            </div>

            <div class="row"><!-- Contenu de la table Utilisateurs !-->
                <div class= "col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Il y a 6 compétences</h2>
                            <h3 class="panel-title"></h3>
                        </div>
                        <div class="container-fluid">
                            <div class="panel-body">
                                <h3>Compétences</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><b>Compétences</b></th>
                                                <th><b>Niveau en %</b></th>
                                                <th><b>Suppression</b></th>
                                                <th><b>Modification</b></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>HTML5</b></td>
                                                <td><b>50</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>

                                            <tr>
                                                <td><b>CSS3</b></td>
                                                <td><b>50</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>
                                            <tr>
                                                <td><b>Javascript</b></td>
                                                <td><b>50</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>
                                            <tr>
                                                <td><b>Bootstrap</b></td>
                                                <td><b>40</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>
                                            <tr>
                                                <td><b>PHP</b></td>
                                                <td><b>40</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>
                                            <tr>
                                                <td><b>MYSQL</b></td>
                                                <td><b>30</b></td>
                                                <td><button type="button" class="btn btn-primary">Supprimer</button></td>
                                                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div><!--Fin d'affichage  !-->
                <div class="col-md-4">
                    <div class=" panel panel-default">
                        <div class="panel-body">

                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insérez une compétence</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="utilisateur">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Niveau en %</label>
                                    <input type="password" name="compétences" class="form-control" id="exampleInputPassword1" placeholder="mot de passe">
                                </div>

                                <button type="submit" class="btn btn-info btn-block">Insérez</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-heading">
                                <h3>Niveau en %</h3>
                                <span>HTML5</span><br/>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                                <span>CSS3</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                                <span>Javascript</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (warning)</span>
                                    </div>
                                </div>
                                <span>PHP</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                                <span>MYSQL</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                        <span class="sr-only">80% Complete (danger)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        


        <!-- Quelques modifications --> 
        






        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
    </html>
