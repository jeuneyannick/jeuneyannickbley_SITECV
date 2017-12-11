<?php
$hote = 'localhost';
$bdd = 'cv_yannick';
$utilisateur = 'root';
$passe='';

$pdo = new PDO ('mysql:host='. $hote . ';dbname='.$bdd, $utilisateur, $passe);
// Ma variable pour ma connexion à la base de données
$pdo ->exec("SET NAMES UTF8");
