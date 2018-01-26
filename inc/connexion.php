<?php
$hote = 'yannickbfn1246yb.mysql.db';
$bdd = 'yannickbfn1246yb';
$utilisateur = 'yannickbfn1246yb';
$passe='Soukainahamdou92';

$pdo = new PDO ('mysql:host='. $hote . ';dbname='.$bdd, $utilisateur, $passe);
// Ma variable pour ma connexion à la base de données
$pdo ->exec("SET NAMES UTF8");

?>
