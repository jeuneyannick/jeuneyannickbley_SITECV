<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);





//je récupère la compétence

$id_competence = $_GET['id_competence']; //..par l'id et $_GET
$req=$pdo->query("SELECT * FROM t_competences WHERE id_competence='$id_competence'"); //la requete est egale à l'id
$ligne_competence= $req->fetch();



// mise à jour d'une compétence

if(isset($_POST['competence'])){//par le nom du premier input
    $competence = addslashes($_POST['competence']);
    $c_niveau  = addslashes($_POST['c_niveau']);
    $id_competence = $_POST['id_competence'];

    $pdo->exec("UPDATE t_competences SET competence ='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence'");
    header('location: competences.php');
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
        $req= $pdo->query("SELECT * FROM t_competences WHERE id_competence='$id_competence'");
        $ligne_competence = $req->fetch();
        ?>

        <h2>Modification d'une competence</h2>

        <p><?php echo $ligne_competence['competence']; ?></p>
        <form action="modif_competences.php" method="post">

            <label for="competence">Competence</label>
            <input type="text" name="competence" value="<?php echo $ligne_competence['competence'];?>">
            <input type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau'];?>">
            <input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence'];?>">
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
    </html>
