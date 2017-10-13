<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);
if($req -> rowCount() > 0){
    echo '<pre>';
    print_r($ligne_utilisateur);
    echo'</pre>';
}

?>
<?php
//je récupère la compétence

$id_competence = $_GET['id_competence']; //..par l'id et $_GET
$req=$pdo->query("SELECT* FROM t_competences WHERE id_competence= '$id_competence'"); //la requete est egale à l'id
$ligne_competence= $req->fetch();
print_r($ligne_competence); 







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
    <?php

    echo '<table border="1">';

    echo '<tr>';

    foreach($ligne_utilisateur as $indice => $valeur){
        echo '<td>' . $valeur. '</td>';
    }
    echo '</tr>';
    echo '</table>';


    ?>
    <hr>

    <h1>Admin du site cv de <?php echo ($ligne_utilisateur['pseudo']); ?></h1>
    <p>Texte</p>
    <hr>
    <?php
      $req= $pdo->query("SELECT * FROM t_competences");
      $ligne_competence = $req->fetch();
      ?>

     <h2>Modification d'une competence</h2>
     <p>texte</p>
</body>
</html>
