<?php
// gestion des contenus de la bdd


require_once('connexion.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);




//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['loisir']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['loisir'])){

        $loisirs = addslashes($_POST['loisir']);
        $pdo->exec("INSERT INTO t_loisirs VALUES (NULL,'$loisirs','1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location:loisirs.php");//pour revenir sur la page
        exit();

    }
}


//suppression d'un loisir

if(isset($_GET['id_loisir'])){// on récupère la comp. par son id dans l'URL
    $efface = $_GET['id_loisir'];// je mets cela dans une variable

    $req="DELETE FROM t_loisirs WHERE id_loisir = '$efface'";
    $pdo->query($req);// on peut utiliser avec exec aussi si on veut
    header("location: loisirs.php");

}//Ferme le if isset



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_admin.css" rel="stylesheet">
    <title>Admin : <?= $ligne_utilisateur['prenom'] . ' :  ' . $ligne_utilisateur['nom'] ; ?> nom</title>
</head>
<body>
    <?php include('inc/nav_inc.php'); ?>

    <hr>
    <?php
    $req= $pdo->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_loisirs = $req-> rowCount();
    ?>

    <div class="container-fluid" id="back">
        <div class="container" id="font">
            <div class="row"><!-- Contenu du premier affichage !-->

                <div class= "col-md-8">

                    <div class="well">
                        <h1>Admin du site cv de <?= $ligne_utilisateur['pseudo'];?></h1>
                    </div>

                </div><!--Fin de la div du contenu du premier affichage !-->
            </div>

            <div class="row"><!-- Contenu de la table Utilisateurs !-->
                <div class= "col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Il y a <?= $nbr_loisirs;?> loisirs</h2>
                            <h3 class="panel-title"></h3>
                        </div>
                        <div class="container-fluid">
                            <div class="panel-body">
                                <h3>Compétences</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><b>Loisirs</b></th>
                                                <th><b>Suppression</b></th>
                                                <th><b>Modification</b></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($ligne_loisir=$req->fetch()){ ?>
                                                <tr>
                                                    <td><?php echo $ligne_loisir['loisir'];?></td>
                                                    <td><a class="btn btn-primary" href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Supprimer</a></td>
                                                    <td><a class="btn btn-primary" href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Modifier</a></td>

                                                </tr>
                                            <?php } ?>
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







</div>



</body>
</html>
