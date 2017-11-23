<?php
// gestion des contenus de la bdd
//suppression d'une competence
require_once('init/connect.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);




//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['r_titre']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['r_titre']) && !empty($_POST['r_soustitre']) && !empty($_POST['r_dates']) && !empty($_POST['r_description'])){
        echo "problème";
        $r_titre = addslashes($_POST['r_titre']);
        $r_soustitre = addslashes($_POST['r_soustitre']);
        $r_dates = addslashes($_POST['r_dates']);
        $r_description = addslashes($_POST['r_description']);
        $pdo->exec("INSERT INTO t_realisations VALUES (NULL,'$r_titre','$r_soustitre','$r_dates','$r_description', '1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location: realisations.php");//pour revenir sur la page
        exit();

    }
}


//suppression d'une compétence

if(isset($_GET['id_realisation'])){// on récupère la comp. par son id dans l'URL
    $efface = $_GET['id_realisation'];// je mets cela dans une variable

    $req="DELETE FROM t_realisations WHERE id_realisation = '$efface'";
    $pdo->query($req);// on peut utiliser avec exec aussi si on veut
    header("location: realisations.php");

}//Ferme le if isset

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : <?= $ligne_utilisateur['prenom'] . ' :  ' . $ligne_utilisateur['nom'] ; ?> nom</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <?php require_once('inc/nav_inc.php'); ?>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
    <hr>
    <?php
    $req= $pdo->prepare("SELECT * FROM t_realisations WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_realisations = $req-> rowCount();
    ?>

    <h2>il y a <?= $nbr_realisations; ?> realisations</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Réalisations
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">


                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Soustitre</th>
                                    <th>Dates</th>
                                    <th>Description</th>
                                    <th>Suppression</th>
                                    <th>Modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($ligne_realisation= $req->fetch()){ ?>

                                    <tr>

                                        <td><?php echo $ligne_realisation['r_titre']; ?></td>
                                        <td><?php echo $ligne_realisation['r_soustitre']; ?></td>
                                        <td><?php echo $ligne_realisation['r_dates']; ?></td>
                                        <td><?php echo $ligne_realisation['r_description']; ?></td>
                                        <td><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation'];?>">Supprimer</a></td>
                                        <td><a href="modif_realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation'];?>">Modifier</a></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Insertion d'une realisation
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="r_titre" id="r_titre" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_soustitre">Soustitre</label>
                                <input type="text" name="r_soustitre" id="r_soustitre" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_dates">Dates</label>
                                <input type="text" name="r_dates" id="r_dates" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_description">Description</label>
                                <input type="text" name="r_description" id="r_description" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-warning btn-block" value="Inserer">

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <footer>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
