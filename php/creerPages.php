<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require '../server/DB.inc.php';

session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    if (isset($_POST['submit'])) {

        $portfolio_cookie =  html_entity_decode($_COOKIE['portfolio']);
        $portfolio_json = json_decode($portfolio_cookie);

        $username = $_SESSION['username'];
        $nomPortfolio = $_POST['nomPortfolio'];
        $accessible  = isset($_POST['accessible']);
        if($accessible){
            $accessible = 1;
        }else{
            $accessible = 0;
        }

        $DB = DB::getInstance();

        $result = $DB->addPortfolio($username, $nomPortfolio, $accessible);
        if($result) {
            echo "Portfolio créé avec succès";
        }
        else {
            echo "Erreur lors de la création du portfolio";
        }
    }else{
        echo "Erreur de récupération des données";
    }  
}else{
    header("Location: connexion.php");    
}


function creerPages($portfolioJSON){
    //TODO: creer les pages du portfolio

    $jsonCV;
    $jsonCompetences = $portfolioJSON->competences;
    $jsonProjets = $portfolioJSON->projets;
    $jsonParcours = $portfolioJSON->parcours;


    //return $jsonCompetences;
}

?>