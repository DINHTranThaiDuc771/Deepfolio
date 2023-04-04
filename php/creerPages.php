<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require '../server/DB.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  

if( !isset($_SESSION["loggedin"])) {
    header("Location: connexion.php");
    exit();    
}

$db;
$username;
$numPortfolio;


if (isset($_POST['nomPortfolio'])) {

    $portfolio_cookie =  html_entity_decode($_COOKIE['portfolio']);
    $portfolio_json = json_decode($portfolio_cookie);

    $username = $_SESSION['user']->getNomUtilisateur();
    $nomPortfolio = $_POST['nomPortfolio'];
    $accesible  = isset($_POST['accesible']);

    $db = DB::getInstance();

    $result = $db->addPortfolio($username, $nomPortfolio, var_export($accesible, true));

    if($result) {
        creerPages($portfolio_json, $db);
    }
    else {
        echo "Erreur lors de la création du portfolio";
    }

}



function creerPages($portfolioJSON, $db){

    $jsonCV = null;
    $competences = $portfolioJSON->competences;
    $projets = $portfolioJSON->projets;
    $parcours = $portfolioJSON->parcours;

    $username       = $_SESSION['user']->getNomUtilisateur();
    $numPortfolio   = $db->getNewestPortfolioId($username);

    creerJsonCompetences($competences);
    creerJsonProjets($projets);
    creerJsonParcours($parcours);
    creerJsonPageCV($portfolioJSON);

    $url['auteur'] = $username;
    $url['idPortfolio'] = $numPortfolio;

    header("Location: visualisation.php?cle=\"" . base64_encode(json_encode($url)) . "\""); 
}

function creerPageCompetences($competences) {

    $competencesString = '{"competences": ';

    $competencesString .= json_encode($competences);

    $competencesString .= "}";

    $jsonCompetences = json_encode($competencesString);


    global $db, $username, $numPortfolio;

    $db->addPage($username, $numPortfolio, $jsonCompetences, "competences");
}

function creerPageProjets($projets){
    
    $projetsString = '{"projets": ';

    $projetsString .= json_encode($projets);

    $projetsString .= "}";

    $jsonProjets = json_encode($projetsString);

    global $db, $username, $numPortfolio;

    $db->addPage($username, $numPortfolio, $jsonProjets, "projets");
}

function creerPageParcours($parcours){
        
    $parcoursString = '{"parcours": ';
    
    $parcoursString .= json_encode($parcours);

    $parcoursString .= "}";

    $jsonParcours = json_encode($parcoursString);

    global $db, $username, $numPortfolio;

    $db->addPage($username, $numPortfolio, $jsonParcours, "parcours");
}

function creerPageCV($portfolio_json){

    $stringCV = json_encode($portfolio_json);

    $stringCV = '{' . substr($stringCV, 1, strlen($stringCV) -1 );

    $jsonCV = json_encode($stringCV);

    global $db, $username, $numPortfolio;

    $db->addPage($username, $numPortfolio, $jsonCV, "cv");
}

?>