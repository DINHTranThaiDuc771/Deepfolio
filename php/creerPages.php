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


if(!isset($_POST['nomPortfolio'])) {
    header("Location: ./accueil.php");
    exit();
}


$portfolio_cookie =  html_entity_decode($_COOKIE['portfolio']);

$reseauxCookie = html_entity_decode($_COOKIE['tabReseaux']);
$diplomesCookie = html_entity_decode($_COOKIE['tabDiplomes']);
$parcoursCookie = html_entity_decode($_COOKIE['tabParcours']);
$projetsCookie = html_entity_decode($_COOKIE['tabProjets']);
$competencesCookie = html_entity_decode($_COOKIE['tabCompetences']);

$portfolio_json     = json_decode($portfolio_cookie);
$reseaux_json       = json_decode($reseauxCookie);
$diplomes_json      = json_decode($diplomesCookie);
$parcours_json      = json_decode($parcoursCookie);
$projets_json       = json_decode($projetsCookie);
$competences_json   = json_decode($competencesCookie);


$username = $_SESSION['user']->getNomUtilisateur();
$nomPortfolio = htmlspecialchars($_POST['nomPortfolio']);
$accesible  = isset($_POST['accesible']);

$db = DB::getInstance();

$result = $db->addPortfolio($username, $nomPortfolio, var_export($accesible, true));
var_dump($reseaux_json);

if($result) {
    //creerPages($portfolio_json, $db);
}
else {
    echo "Erreur lors de la création du portfolio";
}



$db;
$username;
$numPortfolio;

function creerPages($portfolioJSON, $reseaux_json, $diplomes_json, $parcours_json, $projets_json, $competences_json, $db){

    global $username, $numPortfolio;


    $numPortfolio   = $db->getNewestPortfolioId($username);

    $portfolioComplet_json["reseaux"] = json_encode($reseaux_json); //TODO: PIERRE: CONCATERNER TOUTES LES INFOS DANS CE TABLEAU
    var_dump($portfolioComplet_json);

    /*
    creerPageCompetences($competences_json);
    creerPageDiplomes($diplomes_json);
    creerPageProjets($projets_json);
    creerPageParcours($parcours_json);
    creerPageReseaux($reseaux_json);
    creerPageCV($portfolioComplet_json);
    creerPageInfo($portfolioComplet_json);

    $url['auteur'] = $username;
    $url['idPortfolio'] = $numPortfolio;

    header("Location: visualisation.php?cle=\"" . base64_encode(json_encode($url)) . "\""); 
    */
}

function creerPageCompetences($competences) {

    global $db, $username, $numPortfolio;

    $competencesString = '{"competences": ';

    $competencesString .= json_encode($competences);

    $competencesString .= "}";

    $db->addPage($username, $numPortfolio, $competencesString, "competences");
}

function creerPageDiplomes($diplomes){

    global $db, $username, $numPortfolio;

    $diplomesString = '{"diplomes": ';

    $diplomesString .= json_encode($diplomes);

    $diplomesString .= "}";

    $db->addPage($username, $numPortfolio, $diplomesString, "diplomes");
}

function creerPageProjets($projets){

    global $db, $username, $numPortfolio;

    $projetsString = '{"projets": ';

    $projetsString .= json_encode($projets);

    $projetsString .= "}";

    $db->addPage($username, $numPortfolio, $projetsString, "projets");
}

function creerPageParcours($parcours){

    global $db, $username, $numPortfolio;

    $parcoursString = '{"parcours": ';
    
    $parcoursString .= json_encode($parcours);

    $parcoursString .= "}";

    $db->addPage($username, $numPortfolio, $parcoursString, "parcours");
}

function creerPageCV($portfolio_json){

    global $db, $username, $numPortfolio;

    $stringCV = json_encode($portfolio_json);

    $stringCV = '{' . substr($stringCV, 1, strlen($stringCV) -1 );

    $db->addPage($username, $numPortfolio, $stringCV, "cv");
}

function creerPageReseaux($reseaux) {

    global $db, $username, $numPortfolio;

    $reseauxString = '{"reseaux": ';
    
    $reseauxString .= json_encode($reseaux);

    $reseauxString .= "}";

    $db->addPage($username, $numPortfolio, $reseauxString, "reseaux");
}

function creerPageInfo($competences) {

    global $db, $username, $numPortfolio, $nomPortfolio, $accesible;

    $infos['nomPortfolio'] = $nomPortfolio;
    $infos['accesible'] = $accesible;


    $db->addPage($username, $numPortfolio, json_encode($infos), "infos");
}

?>