<?php

function menuIsActive($page){

    $page = $page.'.php';
    $Route = $_SERVER['SCRIPT_FILENAME'];
    $Route = explode('/', $Route);
    $Route = end($Route);

    if($Route === $page){

        return 'active';
    }
}
