<?php
// gestion des contenus de la bdd
//suppression d'une competence

require_once('connexion.php');


$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur='1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);

?>

<?php
//gestion des contenus de la bdd compétences
//Insertion d'une competence
if(isset($_POST['competence']) ){// si on a posté une nouvelle compétence
    if(!empty($_POST['competence']) && !empty($_POST['c_niveau'])){

        $competence = addslashes($_POST['competence']);
        $c_niveau = addslashes($_POST['c_niveau']);
        $pdo->exec("INSERT INTO t_competences VALUES (NULL,'$competence','$c_niveau','1')");//mettre $id_utilisateur quand on l'aura dans la variable de session
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
</head>
<body>
    
    <hr>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
    <p>Texte</p>
    <hr>
    <?php
    $req= $pdo->prepare("SELECT * FROM t_competences WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_competences = $req-> rowCount();
    ?>

    <h2>il y a <?= $nbr_competences; ?> competences</h2>

    <table border=2>

        <tr>

            <th>Compétences</th>
            <th>Niveau en %</th>
            <th>Suppression</th>
            <th>Modification</th>
        </tr>
        <?php while($ligne_competence = $req->fetch()){ ?>

            <tr>
                <td><?php echo $ligne_competence['competence']; ?></td>
                <td><?php echo $ligne_competence['c_niveau']; ?></td>
                <td><a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence'];?>">Supprimer</a></td>
                <td><a href="modif_competences.php?id_competence=<?php echo $ligne_competence['id_competence'];?>">Modifier</a></td>

            </tr>
        <?php } ?>
    </table>
    <hr></hr>

    <h3>Insertion d'une compétence</h3>

    <form method="post" action="competences.php">

        <label for="competence">Competence</label>
        <input type="text" name="competence" id="competence" placeholder="Inserez une compétence">
        <input type="text" name="c_niveau" id="c_niveau" placeholder="Inserez le niveau">
        <input type="submit" value="Inserez">

    </form>


</body>
</html>
