<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  

if (!isset($_SESSION["loggedin"]) && !isset($_SESSION["username"])) {
    header('location: ./connexion.php');
}else{
    $DB = DB::getInstance();

    $username = $_SESSION["username"];

    $listePortfolios = $DB->getPortfolios($username);
}




?>