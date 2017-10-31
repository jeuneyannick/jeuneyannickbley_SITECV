<?php
// gestion des contenus de la bdd
//suppression d'une competence

require_once('connexion.php');


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
</head>
<body>

    <hr>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
    <p>Texte</p>
    <hr>
    <?php
    $req= $pdo->prepare("SELECT * FROM t_experiences WHERE utilisateur_id= '1'");
    $req->execute();
    $nbr_experiences = $req-> rowCount();
    ?>

    <h2>il y a <?= $nbr_experiences; ?> experiences</h2>

    <table border=2>

        <tr>

            <th>Experiences</th>
            <th>Titre</th>
            <th>Soustitre</th>
            <th>Description</th>
            <th>Suppression</th>
            <th>Modification</th>
        </tr>
        <?php while($ligne_experience = $req->fetch()){ ?>

            <tr>
                <td><?php echo $ligne_experience['e_titre']; ?></td>
                <td><?php echo $ligne_experience['e_soustitre']; ?></td>
                <td><?php echo $ligne_experience['e_dates']; ?></td>
                <td><?php echo $ligne_experience['e_description']; ?></td>
                <td><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience'];?>">Supprimer</a></td>
                <td><a href="modif_experiences.php?id_experience=<?php echo $ligne_experience['id_experience'];?>">Modifier</a></td>

            </tr>
        <?php } ?>
    </table>
    <hr></hr>

    <h3>Insertion d'une experience</h3>

    <form method="post" action="experiences.php">
        <label for="experiences">Experiences</label>
        <input type="text" name="e_titre" id="e_titre" placeholder="Inserez un titre">
        <input type="text" name="e_soustitre" id="e_soustitre" placeholder="Inserez un sous-titre">
        <input type="text" name="e_dates" id="e_dates" placeholder="Inserez une date">
        <input type="text" name="e_description" id="e_description" placeholder="Inserez une description">
        <input type="submit" value="Inserez">
    </form>



</body>
</html>
