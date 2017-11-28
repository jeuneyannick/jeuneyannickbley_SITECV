<?php

// fonction pour voir si un utilisateur est connecté:
function userConnecte(){
	if(isset($_SESSION['id_utilisateur'])){
		return TRUE;
	}
	else{
		return FALSE;
	}
}



function menuIsActive($page){

    $page = $page.'.php';
    $Route = $_SERVER['SCRIPT_FILENAME'];
    $Route = explode('/', $Route);
    $Route = end($Route);

    if($Route === $page){

        return 'active';
    }
}

 ?>
