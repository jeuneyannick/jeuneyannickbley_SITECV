
<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);








// mise à jour d'une compétence

if(isset($_POST['e_titre'])){//par le nom du premier input
    $e_titre = addslashes($_POST['e_titre']);
    $e_soustitre = addslashes($_POST['e_soustitre']);
    $e_dates = addslashes($_POST['e_dates']);
    $e_description = addslashes($_POST['e_description']);
    $id_experience= $_POST['id_experience'];

    $pdo->exec("UPDATE t_experiences SET e_titre ='$e_titre', e_soustitre='$e_soustitre', e_dates= '$e_dates', e_description= '$e_description'  WHERE id_experience='$id_experience'");
    header('location: experiences.php');
    exit();

} //fermeture if isset

//je récupère l'experience

$id_experience = $_GET['id_experience']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_experiences WHERE id_experience='$id_experience'"); //la requete est egale à l'id
$ligne_experience= $req->fetch();

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
        $req= $pdo->query("SELECT * FROM t_experiences WHERE id_experience='$id_experience'");
        $ligne_experience = $req->fetch();
        ?>

        <h2>Modification d'une experience</h2>

        <p><?php echo $ligne_experience['e_titre']; ?></p>
        <form action="modif_experiences.php" method="post">

            <label for="Titre">Titre</label>

            <input type="text" name="e_titre" value="<?php echo $ligne_experience['e_titre'];?>">

            <input type="text" name="e_soustitre" value="<?php echo $ligne_experience['e_soustitre'];?>">

            <input type="text" name="e_dates" value="<?php echo $ligne_experience['e_dates'];?>">

            <input type="text" name="e_description" value="<?php echo $ligne_experience['e_description'];?>">

            <input hidden name="id_experience" value="<?php echo $ligne_experience['id_experience'];?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
    </html>
