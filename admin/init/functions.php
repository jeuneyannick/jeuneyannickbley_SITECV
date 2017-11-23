<?php
session_start();


// fonction pour voir si un utilisateur est connecté:
function userConnecte(){
	if(isset($_SESSION['id_utilisateur'])){
		return TRUE;
	}
	else{
		return FALSE;
	}
}





 ?>
