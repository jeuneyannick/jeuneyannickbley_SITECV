<?php
// gestion des contenus de la bdd


require_once('init/connect.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);




//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['loisir']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['loisir'])){

        $loisirs = addslashes($_POST['loisir']);
        $pdo->exec("INSERT INTO t_loisirs VALUES (NULL,'$loisirs','1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location: loisirs.php");//pour revenir sur la page
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
    <title>Admin : <?= $ligne_utilisateur['prenom'] . ' :  ' . $ligne_utilisateur['nom'] ; ?> nom</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
    <?php require_once('inc/nav_inc.php');
    $req= $pdo->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_loisirs = $req-> rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-offset-md-6 col-md-6 ">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                            <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                            <h2>Il y a <?= $nbr_loisirs; ?> loisirs</h2>
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
                        Loisirs
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">


                            <thead>
                                <tr>
                                    <th>Loisirs</th>
                                    <th>Suppression</th>
                                    <th>Modification</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($ligne_formation= $req->fetch()){ ?>

                                    <tr>

                                        <td><?php echo $ligne_formation['loisir']; ?></td>
                                        <td><a href="loisirs.php?id_loisir=<?php echo $ligne_formation['id_loisir'];?>">Supprimer</a></td>
                                        <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_formation['id_loisir'];?>">Modifier</a></td>

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
                        Insertion d'un loisir
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="loisirs">Loisirs</label>
                                <input type="text" name="loisir" id="f_titre" placeholder="Inserez une formation" class="form-control">
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
