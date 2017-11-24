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

$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_competence = $_GET['id_competence']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_competences WHERE id_competence='$id_competence'"); //la requete est egale à l'id
$ligne_competence= $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['competence'])){//par le nom du premier input
    $competence = addslashes($_POST['competence']);
    $c_niveau  = addslashes($_POST['c_niveau']);
    $id_competence = $_POST['id_competence'];

    $pdo->exec("UPDATE t_competences SET competence ='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence'");
    header('location: competences.php');
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
    <?php require_once('inc/nav_inc.php');  ?>


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
    $req= $pdo->query("SELECT * FROM t_competences WHERE id_competence='$id_competence'");
    $ligne_competence = $req->fetch();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h2>Modification d'une compétence</h2>


                    </div>
                    <div class="panel-body">
                        <form action="modif_competences.php" method="post">
                            <div class="form-group">
                                <label for="competence">competence</label>

                                <input type="text" name="competence" class="form-control" value="<?php echo $ligne_competence['competence'];?>">
                            </div>
                            <div class="form-group">
                                <label for="c_niveau">Niveau</label>
                                <input type="text" name="c_niveau" class="form-control" value="<?php echo $ligne_competence['c_niveau'];?>">
                            </div>

                            <input hidden name="id_competence"  value="<?php echo $ligne_competence['id_competence'];?>">

                            <input type="submit" class="btn btn-warning btn-block" value="Mettre à jour">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
