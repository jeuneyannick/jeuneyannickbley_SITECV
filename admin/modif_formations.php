<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_formation = $_GET['id_formation']; //..par l'id et $_GET
$req=$pdo->query("SELECT* FROM t_formations WHERE id_formation='$id_formation'"); //la requete est egale à l'id
$ligne_formation= $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['f_titre'])){//par le nom du premier input
    $f_titre = addslashes($_POST['f_titre']);
    $f_soustitre  = addslashes($_POST['f_soustitre']);
    $f_dates  = addslashes($_POST['f_dates']);
    $f_description  = addslashes($_POST['f_description']);
    $id_formation = $_POST['id_formation'];

    $pdo->exec("UPDATE t_formations SET f_titre ='$f_titre', f_soustitre='$f_soustitre', f_dates='$f_dates', f_description='$f_description' WHERE id_formation='$id_formation'");
    header('location: formations.php');
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

        <h1>Admin du site cv de <?php echo ($ligne_utilisateur['prenom']); ?></h1>
        <p>Texte</p>
        <hr>
        <?php
        $req= $pdo->query("SELECT * FROM t_formations WHERE id_formation='$id_formation'");
        $ligne_formation = $req->fetch();
        ?>

        <h2>Modification d'une formation</h2>

        <p><?php echo $ligne_formation['f_titre']; ?></p>
        <p><?php echo $ligne_formation['f_soustitre']; ?></p>
        <p><?php echo $ligne_formation['f_dates']; ?></p>
        <p><?php echo $ligne_formation['f_description']; ?></p>
        <form action="modif_formations.php" method="post">

            <label for="f_titre">Titre</label>

            <input type="text" name="f_titre" value="<?php echo $ligne_formation['f_titre'];?>">

            <input type="text" name="f_soustitre" value="<?php echo $ligne_formation['f_soustitre'];?>">

            <input type="text" name="f_dates" value="<?php echo $ligne_formation['f_dates'];?>">

            <input type="text" name="f_description" value="<?php echo $ligne_formation['f_description'];?>">

            <input hidden name="id_formation" value="<?php echo $ligne_formation['id_formation'];?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
    </html>