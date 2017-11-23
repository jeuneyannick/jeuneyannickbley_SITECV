<?php
// gestion des contenus de la bdd
//suppression d'une competence

require_once('init/connect.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);

?>

<?php
//gestion des contenus de la bdd compétences
//Insertion d'une experience
if(isset($_POST['e_titre'])){// si on a posté une nouvelle experience
    if(!empty($_POST['e_titre']) && !empty($_POST['e_soustitre']) && !empty($_POST['e_dates']) && !empty($_POST['e_description']) ){

        $e_titre = addslashes($_POST['e_titre']);
        $e_soustitre = addslashes($_POST['e_soustitre']);
        $e_dates = addslashes($_POST['e_dates']);
        $e_description = addslashes($_POST['e_description']);
        $pdo->exec("INSERT INTO t_experiences VALUES (NULL,'$e_titre' ,'$e_soustitre' ,'$e_dates' ,'$e_description' ,'1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
        header("location: experiences.php");//pour revenir sur la page
        exit();

    }
}







//suppression d'une compétence

if(isset($_GET['id_experience'])){// on récupère la comp. par son id dans l'URL
    $efface = $_GET['id_experience'];// je mets cela dans une variable

    $req="DELETE FROM t_experiences WHERE id_experience = '$efface'";
    $pdo->query($req);// on peut utiliser avec exec aussi si on veut
    header("location: experiences.php");

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
    $req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_experiences = $req-> rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
                        <h2>il y a <?= $nbr_experiences; ?> experiences</h2>
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
                        Experiences
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
                                <?php while($ligne_experiences= $req->fetch()){ ?>

                                    <tr>

                                        <td><?php echo $ligne_experiences['e_titre']; ?></td>
                                        <td><?php echo $ligne_experiences['e_soustitre']; ?></td>
                                        <td><?php echo $ligne_experiences['e_dates']; ?></td>
                                        <td><?php echo $ligne_experiences['e_description']; ?></td>
                                        <td><a href="experiences.php?id_experience=<?php echo $ligne_experiences['id_experience'];?>">Supprimer</a></td>
                                        <td><a href="modif_experiences.php?id_experience=<?php echo $ligne_experiences['id_experience'];?>">Modifier</a></td>

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
                        Insertion d'une formation
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="e_titre" id="e_titre" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_soustitre">Soustitre</label>
                                <input type="text" name="e_soustitre" id="e_soustitre" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_dates">Formations</label>
                                <input type="text" name="e_dates" id="e_dates" placeholder="Inserez une formation" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_description">Description</label>
                                <input type="text" name="e_description" id="e_description" placeholder="Inserez une formation" class="form-control">
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
