<?php
require_once('init/connect.php');
session_start();// à mettre dans toutes les pages de l'admin
if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom= $_SESSION['nom'];

}else{ // l'utilisateur  n'est pas connecté
    header('location:connexion.php');
}

$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_formation = $_GET['id_formation']; //..par l'id et $_GET
$req=$pdo->query("SELECT* FROM t_formations WHERE id_formation='$id_formation'"); //la requete est egale à l'id
$ligne_formation= $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['f_titre'])){//par le nom du premier input
    $f_titre = addslashes($_POST['f_titre']);
    $f_lieu  = addslashes($_POST['f_lieu']);
    $f_dates  = addslashes($_POST['f_dates']);
    $f_description  = addslashes($_POST['f_description']);
    $id_formation = $_POST['id_formation'];

    $pdo->exec("UPDATE t_formations SET f_titre ='$f_titre', f_lieu ='$f_lieu', f_dates='$f_dates', f_description='$f_description' WHERE id_formation='$id_formation'");
    header('location: formations.php');
    exit();

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_admin.css">
    <title>Admin : <?= $ligne_utilisateur['prenom'] . ' :  ' . $ligne_utilisateur['nom'] ; ?> nom</title>
</head>
<body>

    <?php require_once('inc/nav_inc.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-warning" role="alert">
                    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <?php
    $req= $pdo->query("SELECT * FROM t_formations WHERE id_formation='$id_formation'");
    $ligne_formation = $req->fetch();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>Modification d'une formation</h2>
                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <form action="modif_formations.php" method="post">
                                <div class="form-group">
                                    <label for="f_titre">Titre</label>
                                    <input type="text" name="f_titre" class="form-control" value="<?php echo $ligne_formation['f_titre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="f_lieu">Lieu</label>
                                    <input type="text" name="f_lieu" class="form-control" value="<?php echo $ligne_formation['f_lieu'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="dates">Dates</label>
                                    <input type="text" name="f_dates" class="form-control" value="<?php echo $ligne_formation['f_dates'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" id="editor1" name="f_description" class="form-control"><?php echo $ligne_formation['f_description'];?></textarea>
                                </div>

                                <input hidden name="id_formation"  value="<?php echo $ligne_formation['id_formation'];?>">

                                <input type="submit" class="btn btn-warning btn-block" value="Mettre à jour">
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                CKEDITOR.replace('editor1');
                </script>

            </div>
        </div>
    </div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
