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








// mise à jour d'une compétence

if(isset($_POST['e_titre'])){//par le nom du premier input
    $e_titre = addslashes($_POST['e_titre']);
    $e_soustitre = addslashes($_POST['e_soustitre']);
    $e_dates = addslashes($_POST['e_dates']);
    $e_description = addslashes($_POST['e_description']);
    $id_experience= $_POST['id_experience'];

    $pdo->exec("UPDATE t_experiences SET e_titre ='$e_titre', e_soustitre='$e_soustitre', e_dates= '$e_dates', e_description= '$e_description'  WHERE id_experience='$id_experience'");
    header('location: experiences.php');
    exit();

} //fermeture if isset

//je récupère l'experience

$id_experience = $_GET['id_experience']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_experiences WHERE id_experience='$id_experience'"); //la requete est egale à l'id
$ligne_experience= $req->fetch();

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
    <?php require_once('inc/nav_inc.php'); ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-info" role="alert">
                    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                    <p>Texte</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    $req= $pdo->query("SELECT * FROM t_experiences WHERE id_experience='$id_experience'");
    $ligne_experience = $req->fetch();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>Modification d'une experience</h2>


                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <form action="modif_experiences.php" method="post">
                                <div class="form-group">
                                    <label for="e_titre">Titre</label>

                                    <input type="text" name="e_titre" class="form-control" value="<?php echo $ligne_experience['e_titre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="soustitre">Soustitre</label>
                                    <input type="text" name="e_soustitre" class="form-control" value="<?php echo $ligne_experience['e_soustitre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="dates">Dates</label>
                                    <input type="text" name="f_dates" class="form-control" value="<?php echo $ligne_experience['e_dates'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="f_description" class="form-control" value="<?php echo $ligne_experience['e_description'];?>">
                                </div>

                                <input hidden name="id_experience"  value="<?php echo $ligne_experience['id_experience'];?>">

                                <input type="submit" class="btn btn-warning btn-block" value="Mettre à jour">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
