<?php

if (session_status() == PHP_SESSION_NONE) {
    //header('location: ./connexion.php');
    header('location: ../html/connexion.html');
}else{

    $DB = DB::getInstance();

    $username = $_SESSION["username"];

    $listePortfolios = $DB->getPortfolios($username);


}




?>