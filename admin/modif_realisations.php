<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_realisation = $_GET['id_realisation']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_realisations WHERE id_realisation='$id_realisation'"); //la requete est egale à l'id
$ligne_realisation = $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['r_titre'])){//par le nom du premier input
    $r_titre = addslashes($_POST['r_titre']);
    $r_soustitre  = addslashes($_POST['r_soustitre']);
    $r_dates  = addslashes($_POST['r_dates']);
    $r_description  = addslashes($_POST['r_description']);
    $id_realisation = $_POST['id_realisation'];

    $pdo->exec("UPDATE t_realisations SET r_titre ='$r_titre', r_soustitre ='$r_soustitre', r_dates = '$r_dates', r_description='$r_description' WHERE id_realisation='$id_realisation'");
    header('location: realisations.php');
    exit();

}

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
        $req= $pdo->query("SELECT * FROM t_realisations WHERE id_realisation='$id_realisation'");
        $ligne_realisation = $req->fetch();
        ?>

        <h2>Modification d'une realisation</h2>

        <p><?php echo $ligne_realisation['r_titre']; ?></p>
        <form action="modif_realisations.php" method="post">

            <label for="realisations">Realisations</label>
            <input type="text" name="r_titre" value="<?php echo $ligne_realisation['r_titre'];?>">
            <input type="text" name="r_soustitre" value="<?php echo $ligne_realisation['r_soustitre'];?>">
            <input type="text" name="r_dates" value="<?php echo $ligne_realisation['r_dates'];?>">
            <input type="text" name="r_description" value="<?php echo $ligne_realisation['r_description'];?>">
            <input hidden name="id_realisation" value="<?php echo $ligne_realisation['id_realisation'];?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
    </html>