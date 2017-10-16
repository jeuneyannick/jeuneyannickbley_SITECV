<?php
// gestion des contenus de la bdd
require_once('connexion.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);




//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['formation']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['formation'])){

        $formations = addslashes($_POST['formation']);
        $pdo->prepare("INSERT INTO t_formations (f_titre, f_soustitre, f_dates, ) VALUES (NULL,'$formations','1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
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
</head>
<body>
    <hr>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
    <hr>
    <?php
    $req= $pdo->prepare("SELECT * FROM t_formations WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_formations = $req-> rowCount();
    ?>

    <h2>il y a <?= $nbr_formations; ?> formations</h2>

    <table border=2>

        <tr>

            <th>Formations</th>
            <th>Suppression</th>
            <th>Modification</th>
        </tr>
        <?php while($ligne_formation= $req->fetch()){ ?>

            <tr>
                <td><?php echo $ligne_formation['formation']; ?></td>
                <td><a href="formations.php?id_formation=<?php echo $ligne_formation['id_formation'];?>">Supprimer</a></td>
                <td><a href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation'];?>">Modifier</a></td>

            </tr>
        <?php } ?>
    </table>
    <hr></hr>

    <h3>Insertion d'une formation </h3>

    <form method="post" action="formations.php">

        <label for="formations">Formations</label>
        <input type="text" name="formation" id="formation" placeholder="Inserez une formation">
        <input type="submit" value="Inserer">

    </form>


</body>
</html>
