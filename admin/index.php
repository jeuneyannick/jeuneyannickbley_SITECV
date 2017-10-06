<?php
require_once('connexion.php');
$req = $pdo -> query("SELECT * FROM t_utilisateurs");
$ligne_utilisateur = $req -> fetch(PDO::FETCH_ASSOC);
if($req -> rowCount() > 0){
    echo '<pre>';
    print_r($ligne_utilisateur);
    echo'</pre>';
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
    <?php

    echo '<table border="1">';

    echo '<tr>'; 



    foreach($ligne_utilisateur as $indice => $valeur){
        echo '<td>' . $valeur. '</td>';
    }
    echo '</tr>';
    echo '</table>';


    ?>
</body>
</html>
