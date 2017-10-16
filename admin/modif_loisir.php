<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère le loisir

$id_loisir = $_GET['id_loisir']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'"); //la requete est egale à l'id
$ligne_loisir= $req->fetch();



// mise à jour d'un loisir

if(isset($_POST['loisir'])){//par le nom du premier input
    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];

    $pdo->exec("UPDATE t_loisirs SET loisir ='$loisir' WHERE id_loisir='$id_loisir'");
    header('location: loisirs.php');
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
        
        <hr>
        <?php
        $req= $pdo->query("SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'");
        $ligne_loisir = $req->fetch();
        ?>

        <h2>Modification d'un loisir</h2>

        <p><?php echo $ligne_loisir['loisir']; ?></p>
        <form action="modif_loisir.php" method="post">

            <label for="loisirs">Loisirs</label>
            <input type="text" name="loisir" value="<?php echo $ligne_loisir['loisir'];?>">
            <input hidden name="id_loisir" value="<?php echo $ligne_loisir['id_loisir'];?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
    </html>
