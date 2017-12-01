<?php
// gestion des contenus de la bdd
//suppression d'une competence
require_once('init/connect.php');
session_start();// à mettre dans toutes les pages de l'admin
if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom= $_SESSION['nom'];

}else{ // l'utilisateur  n'est pas connecté
    header('location:connexion.php');
}



$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='$id_utilisateur'");
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
        $pdo->exec("INSERT INTO t_realisations VALUES (NULL,'$r_titre','$r_soustitre','$r_dates','$r_description', '$id_utilisateur')");//mettre $id_utilisateur quand on l'aura dans la variable de session
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
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>
    <?php require_once('inc/nav_inc.php');
    $req= $pdo->prepare("SELECT * FROM t_realisations WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_realisations = $req-> rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                        <h2>il y a <?= $nbr_realisations; ?> realisations</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="table-responsive">
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
                                    <textarea name="r_description" id="r_description" placeholder="Inserez une formation" class="form-control"></textarea>
                                </div>
                                <script>
                                CKEDITOR.replace('editor1');
                                </script>
                                <input type="submit" class="btn btn-warning btn-block" value="Inserer">

                            </form>
                        </div>
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
