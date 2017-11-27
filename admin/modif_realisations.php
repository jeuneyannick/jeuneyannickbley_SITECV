<?php
require_once('init/connect.php');
session_start();;// à mettre dans toutes les pages de l'admin
if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $prenom = $_SESSION['prenom'];
    $nom= $_SESSION['nom'];

}else{ // l'utilisateur  n'est pas connecté
    header('location:connexion.php');
}

$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_realisation = $_GET['id_realisation']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_realisations WHERE id_realisation='$id_realisation'"); //la requete est egale à l'id
$ligne_realisation = $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['r_titre'])){//par le nom du premier input
    $r_titre = addslashes($_POST['r_titre']);
    $r_soustitre  = addslashes($_POST['r_soustitre']);
    $r_dates  = addslashes($_POST['r_dates']);
    $r_description  = addslashes($_POST['r_description']);
    $id_realisation = $_POST['id_realisation'];

    $pdo->exec("UPDATE t_realisations SET r_titre ='$r_titre', r_soustitre ='$r_soustitre', r_dates = '$r_dates', r_description='$r_description' WHERE id_realisation='$id_realisation'");
    header('location: realisations.php');
    exit();

}

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
                </div>
            </div>
        </div>
    </div>
    <?php
    $req= $pdo->query("SELECT * FROM t_realisations WHERE id_realisation='$id_realisation'");
    $ligne_realisation = $req->fetch();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>Modification d'une realisation</h2>
                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <form action="modif_realisations.php" method="post">
                                <div class="form-group">
                                    <label for="realisations">Realisations</label>
                                    <input type="text" name="r_titre" class="form-control" value="<?php echo $ligne_realisation['r_titre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="soustitre">Soustitre</label>
                                    <input type="text" name="r_soustitre" class="form-control" value="<?php echo $ligne_realisation['r_soustitre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="dates">Dates</label>
                                    <input type="text" name="r_dates" class="form-control" value="<?php echo $ligne_realisation['r_dates'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" name="r_description" class="form-control" value="<?php echo $ligne_realisation['r_description'];?>">
                                </div>

                                <input hidden name="id_realisation"  value="<?php echo $ligne_realisation['id_realisation'];?>">
                                <input type="submit" class="btn btn-warning btn-block" value="Mettre à jour">
                            </form>
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
