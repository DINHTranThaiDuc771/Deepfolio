<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


include("../server/DB.inc.php");

session_start();

if (!isset($_SESSION['user'])) {
    header('location: connexion.php');
}
    
$user = $_SESSION['user'];
$username = $user->getNomUtilisateur();

if(isset($_POST['supprimerCompte'])){

    $db = DB::getInstance();
    $db->deleteUser($username);

    session_destroy();
    header('location: connexion.php');
    exit();
}

header('Location: accueil.php');
die;


?>