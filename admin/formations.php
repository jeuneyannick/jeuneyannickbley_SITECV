<?php
// gestion des contenus de la bdd
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
if(isset($_POST['f_titre']) ) {// si on a posté une nouvelle compétence
    if(!empty($_POST['f_titre']) && !empty($_POST['f_lieu']) && !empty($_POST['f_dates']) && !empty($_POST['f_description']) ){

        $f_titre = addslashes($_POST['f_titre']);
        $f_lieu = addslashes($_POST['f_lieu']);
        $f_dates = addslashes($_POST['f_dates']);
        $f_description = addslashes($_POST['f_description']);
        $pdo->exec("INSERT INTO t_formations VALUES (NULL,'$f_titre','$f_lieu','$f_dates','$f_description','$id_utilisateur')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location: formations.php");//pour revenir sur la page
        exit();

    }
}


//suppression d'un formation

if(isset($_GET['id_formation'])){// on récupère la comp. par son id dans l'URL
    $efface = $_GET['id_formation'];// je mets cela dans une variable

    $req="DELETE FROM t_formations WHERE id_formation = '$efface'";
    $pdo->query($req);// on peut utiliser avec exec aussi si on veut
    header("location: formations.php");

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
    <?php require_once('inc/nav_inc.php>');
    $req= $pdo->prepare("SELECT * FROM t_formations WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_formations = $req-> rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                        <h2>il y a <?= $nbr_formations; ?> formations</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Formations
                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Lieu</th>
                                        <th>Dates</th>
                                        <th>Description</th>
                                        <th>Suppression</th>
                                        <th>Modification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($ligne_formation= $req->fetch()){ ?>

                                        <tr>

                                            <td><?php echo $ligne_formation['f_titre']; ?></td>
                                            <td><?php echo $ligne_formation['f_lieu']; ?></td>
                                            <td><?php echo $ligne_formation['f_dates']; ?></td>
                                            <td><?php echo $ligne_formation['f_description']; ?></td>
                                            <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation'];?>">Supprimer</a></td>
                                            <td><a href="modif_formations.php?id_formation=<?php echo $ligne_formation['id_formation'];?>">Modifier</a></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Insertion d'une formation
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="f_titre" id="f_titre" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_lieu">Lieu</label>
                                <input type="text" name="f_lieu" id="f_lieu" placeholder="Inserez un lieu de formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_dates">Dates</label>
                                <input type="text" name="f_dates" id="f_dates" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="f_description">Description</label>
                                <textarea name="f_description" id="editor1" class="form-control"></textarea>
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


    <footer>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
