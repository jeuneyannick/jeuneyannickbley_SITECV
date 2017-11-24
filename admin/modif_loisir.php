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

$req = $pdo -> query("SELECT* FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère le loisir

$id_loisir = $_GET['id_loisir']; //..par l'id et $_GET
$req=$pdo->query("SELECT* FROM t_loisirs WHERE id_loisir='$id_loisir'"); //la requete est egale à l'id
$ligne_loisir= $req->fetch();



// mise à jour d'un loisir

if(isset($_POST['loisir'])){//par le nom du premier input
    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];

    $pdo->exec("UPDATE t_loisirs SET loisir ='$loisir' WHERE id_loisir='$id_loisir'");
    header('location: loisirs.php');
    exit();

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_admin.css">
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
    $req= $pdo->query("SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'");
    $ligne_loisir = $req->fetch();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>Modification d'un loisir</h2>


                    </div>
                    <div class="panel-body">
                        <form action="modif_loisir.php" method="post">
                            <div class="form-group">
                                <label for="loisir">Loisirs</label>

                                <input type="text" name="loisir" class="form-control" value="<?php echo $ligne_loisir['loisir'];?>">
                            </div>

                            <input hidden name="id_loisir"  value="<?php echo $ligne_loisir['id_loisir'];?>">

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
