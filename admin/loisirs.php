<?php
// gestion des contenus de la bdd


require_once('connexion.php');


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
</head>
<body>
    <hr>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
    <p>Texte</p>
    <hr>
    <?php
    $req= $pdo->prepare("SELECT* FROM t_loisirs WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_loisirs = $req-> rowCount();
    ?>

    <h2>il y a <?= $nbr_loisirs; ?> loisirs</h2>

    <table border=2>

        <tr>

            <th>Loisirs</th>
            <th>Suppression</th>
            <th>Modification</th>
        </tr>
        <?php while($ligne_loisir= $req->fetch()){ ?>

            <tr>
                <td><?php echo $ligne_loisir['loisir']; ?></td>
                <td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Supprimer</a></td>
                <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir'];?>">Modifier</a></td>

            </tr>
        <?php } ?>
    </table>
    <hr></hr>

    <h3>Insertion d'un loisir </h3>

    <form method="post" action="loisirs.php">

        <label for="Loisirs">Loisirs</label>
        <input type="text" name="loisir" id="loisir" placeholder="Inserez un loisir">
        <input type="submit" value="Inserez">

    </form>


</body>
</html>
