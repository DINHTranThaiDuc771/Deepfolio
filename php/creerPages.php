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

        $username = $_SESSION['user']->getNomUtilisateur();
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
            creerPages($portfolio_json, $DB);
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


function creerPages($portfolioJSON, $DB){
    //TODO: creer les pages du portfolio

    $jsonCV;
    $competences = $portfolioJSON->competences;
    $projets = $portfolioJSON->projets;
    $parcours = $portfolioJSON->parcours;

    $jsonCompetences = creerjsonCompetences($competences);
    $jsonProjets = creerjsonProjets($projets);
    $jsonParcours = creerjsonParcours($parcours);

    $username = $_SESSION['user']->getNomUtilisateur();
    $numPortfolio = $DB->getNewestPortfolioId($username);

    $DB->addPage($username, $numPortfolio, $jsonCompetences);
    $DB->addPage($username, $numPortfolio, $jsonProjets);
    $DB->addPage($username, $numPortfolio, $jsonParcours);
}

function creerjsonCompetences($competences){

    $competencesString = "{'page': 'competences', 'competences': [";
    for($i=0; $i < count($competences); $i++){
        $competencesString .= "{'nom': '" . $competences[$i]->nom . "', 'description': '" . $competences[$i]->description . " 'lien': '". $competences[$i]->lien. "'}";
        if($i < count($competences)-1){
            $competencesString .= ",";
        }
    }
    $competencesString .= "]}";

    return json_encode($competencesString);
}

function creerjsonProjets($projets){
    
    $projetsString = "{'page': 'projets', 'projets': [";
    for($i=0; $i < count($projets); $i++){
        $projetsString .= "{'nom': '" . $projets[$i]->nom . "', 'description': '" . $projets[$i]->description . " 'taille': '". $projets[$i]->taille. "' 'lien': '". $projets[$i]->lien. "' 'image': '". $projets[$i]->image. "'}";
        if($i < count($projets)-1){
            $projetsString .= ",";
        }
    }
    $projetsString .= "]}";

    return json_encode($projetsString);
}

function creerjsonParcours($parcours){
        
    $parcoursString = "{'page': 'parcours', 'parcours': [";
    for($i=0; $i < count($parcours); $i++){
        $parcoursString .= "{'nom': '" . $parcours[$i]->nom . "', 'entreprise': '" .$parcours[$i]->entreprise. "' ,'description': '" . $parcours[$i]->description . " 'dateDebut': '". $parcours[$i]->dateDebut. "' 'dateFin': '" .$parcours[$i]->dateFin."'}";
        if($i < count($parcours)-1){
            $parcoursString .= ",";
        }
    }
    $parcoursString .= "]}";

    return json_encode($parcoursString);
}

?>