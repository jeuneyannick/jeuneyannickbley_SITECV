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

?>

<?php
//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['competence']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['competence']) && !empty($_POST['c_niveau'])){

        $competence = addslashes($_POST['competence']);
        $c_niveau = addslashes($_POST['c_niveau']);
        $pdo->exec("INSERT INTO t_competences VALUES (NULL,'$competence','$c_niveau','$id_utilisateur')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location: competences.php");//pour revenir sur la page
        exit();

    }
}

//suppression d'une compétence

if(isset($_GET['id_competence'])){// on récupère la comp. par son id dans l'URL
    $efface = $_GET['id_competence'];// je mets cela dans une variable
    $req="DELETE FROM t_competences WHERE id_competence = '$efface'";
    $pdo->query($req);// on peut utiliser avec exec aussi si on veut
    header("location: competences.php");

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
    <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>

    <?php require_once('inc/nav_inc.php');
    $req= $pdo->prepare("SELECT * FROM t_competences WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_competences = $req-> rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                        <h2>il y a <?= $nbr_competences; ?> competences</h2>
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
                        Competences
                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>Competence</th>
                                        <th>Niveau</th>
                                        <th>Suppression</th>
                                        <th>Modification</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($ligne_competence= $req->fetch()){ ?>

                                        <tr>

                                            <td><?php echo $ligne_competence['competence']; ?></td>
                                            <td><?php echo $ligne_competence['c_niveau']; ?></td>
                                            <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence'];?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span>Supprimer</button></a></td>
                                            <td><a href="modif_competences.php?id_competence=<?php echo $ligne_competence['id_competence'];?>">Modifier</a></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Insertion d'une compétence
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="competence">Competence</label>
                                <input type="text" name="competence" id="competence" placeholder="Inserez une compétence" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="c_niveau">Niveau</label>
                                <input type="text" name="c_niveau" id="c_niveau" placeholder="Inserez un niveau" class="form-control">
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
