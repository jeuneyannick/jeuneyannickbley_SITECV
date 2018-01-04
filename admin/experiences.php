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

if(isset($_POST['e_titre'])) { // Si on a posté une nouvelle experience
    if($_POST['e_titre'] != '' && $_POST['e_soustitre'] != '' && $_POST['e_employeur']  && $_POST['e_dates'] != '' && $_POST['e_description'] != '')  { // Si experience n'est pas vide
        // $e_titre             = addslashes($_POST['e_titre']);
        // $e_soustitre         = addslashes($_POST['e_soustitre']);
        // $e_dates             = addslashes($_POST['e_dates']);
        // $e_description       = addslashes($_POST['e_description']);
        // $pdo->exec("INSERT INTO t_experiences  VALUES ('$e_titre', '$e_soustitre', '$e_dates', '$e_description', '1')"); // mettre $id_utilisateur quand on l'aura dans la varible de session

        // exit();
        $req =  $pdo->prepare("INSERT INTO t_experiences (e_titre, e_employeur, e_soustitre, e_dates, e_description, utilisateur_id) VALUES (:e_titre, :e_employeur, :e_soustitre, :e_dates, :e_description, '1')");

        $req->bindParam(':e_titre', addslashes($_POST['e_titre']), PDO::PARAM_STR);
        $req->bindParam(':e_employeur', addslashes($_POST['e_employeur']), PDO::PARAM_STR);
        $req->bindParam(':e_soustitre', addslashes($_POST['e_soustitre']), PDO::PARAM_STR);
        $req->bindParam(':e_dates', addslashes($_POST['e_dates']), PDO::PARAM_STR);
        $req->bindParam(':e_description', addslashes($_POST['e_description']), PDO::PARAM_STR);

        if($req->execute()) {
            header('location:experiences.php');
        }
    } // ferme le if $_POST
} // ferme le if isset du form

//gestion des contenus de la bdd compétences
//Insertion d'une experience
// if(isset($_POST['e_titre'])){// si on a posté une nouvelle experience
//     if(!empty($_POST['e_titre']) && !empty($_POST['e_employeur']) && !empty($_POST['e_soustitre']) && !empty($_POST['e_dates']) && !empty($_POST['e_description']) ){
//
//         $e_titre = addslashes($_POST['e_titre']);
//         $e_employeur = addslashes($_POST['e_employeur']);
//         $e_soustitre = addslashes($_POST['e_soustitre']);
//         $e_dates = addslashes($_POST['e_dates']);
//         $e_description = addslashes($_POST['e_description']);
//         $pdo->exec("INSERT INTO t_experiences VALUES (NULL,'$e_titre' ,'$e_soustitre' ,'$e_dates' ,'$e_description' ,'$id_utilisateur,'$e_employeur' )");//mettre $id_utilisateur quand on l'aura dans la variable de session
//         header("location: experiences.php");//pour revenir sur la page
//         exit();
//
//     }
// }







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
    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_admin.css">
</head>
<body>
    <?php require_once('inc/nav_inc.php');
    $req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_experiences = $req->rowCount();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
                        <h2>il y a <?= $nbr_experiences; ?> experiences</h2>
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
                        Experiences
                    </div>
                    <div class="table-responsive">
                        <div class="panel-body">
                            <table class="table table-hover">


                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Employeur</th>
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
                                            <td><?php echo $ligne_experiences['e_employeur']; ?></td>
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
            </div>

            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Insertion d'une experience
                    </div>
                    <div class="panel-body">
                        <form  method="post" action="">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" name="e_titre" id="e_titre" placeholder="Inserez un titre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_employeur">Employeur</label>
                                <input type="text" name="e_employeur" id="e_employeur" placeholder="Inserez un employeur" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_soustitre">Soustitre</label>
                                <input type="text" name="e_soustitre" id="e_soustitre" placeholder="Inserez un sous-titre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_dates">Dates</label>
                                <input type="text" name="e_dates" id="e_dates" placeholder="Inserez une date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="e_description">Description</label>
                                <textarea name="e_description" id="editor1" class="form-control"></textarea>
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
