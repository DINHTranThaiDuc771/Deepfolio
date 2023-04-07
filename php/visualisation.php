<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../server/DB.inc.php';
require_once "../Twig/lib/Twig/Autoloader.php";
require '../server/Competence.inc.php';
require '../server/Projet.inc.php';
require '../server/Diplome.inc.php';
require '../server/Reseau.inc.php';
require '../server/ExperiencePro.inc.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_GET['cle'])){
    header("Location: accueil.php");
    exit();
}

$cle = $_GET['cle'];

$cleDecode = base64_decode($cle);

$jsonCle = json_decode($cleDecode);

$username = $jsonCle->auteur;
$idPortfolio = $jsonCle->idPortfolio;

$db = DB::getInstance();

if($db->isPortfolioAccessible($username, $idPortfolio) !=0){    
    if(!isset($_SESSION["user"]) || $_SESSION["user"]->getNomUtilisateur() != $username){
        header("Location: accueil.php");
        exit();
    }
}

if(isset($_SESSION["user"]) && $_SESSION["user"]->getNomUtilisateur() == $username){
    $estProprio = true;
}else{
    $estProprio = false;
}


Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("../templates"));


//------------ Variables globales ------------//
$nomPortfolio; 
$adresse; 
$reseaux; 
$description; 
$nom;
$prenom; 
$age; 
$competences; 
$projets; 
$parcours; 
$diplomes;
$cv;
$descriptionSite = "";
$mail = "";
$descriptionReseau = "";
$debug = "";
$colorBck = "";
//------------ Variables globales ------------//

if ( array_key_exists("debug", $_GET)) {
    $debug = $_GET['debug'];
}


setcookie('proprio_portfolio', $username, []);


affichePages($username, $idPortfolio, $db);

$tpl = $twig->loadTemplate( "tplVisu.tpl" );

var_dump ($colorBck);

echo $tpl->render(array(
    'nomPortfolio' => $nomPortfolio,
    'ville' => $adresse,
    'mail' => $mail,
    'reseaux' => $reseaux,
    'description' => $description,
    'competences' => $competences,
    'prenom' => $prenom,
    'nom' => $nom,
    'age' => $age,
    'projets' => $projets,
    'postes' => $parcours,
    'diplomes' => $diplomes,
    'cle' => $cle,
    'lienCv'=>$cv,
    'idPortfolio' => $idPortfolio,
    'auteur' => $username,
    'estProprio' => $estProprio,
    'descriptionsite' => $descriptionSite,
    'descriptionreseau' => $descriptionReseau,
    'debug' => $debug,
    'colorBck' => $colorBck
));
        
function affichePages($username, $idPortfolio, $db){
    
    $pages = $db->getPages($username, $idPortfolio);

    foreach($pages as $page) {

        $typePage = $page->getType();
        
        switch($typePage){
            case 'cv':
                recupInfosCV($page);
                break;
            case 'competences':
                recupInfosCompetences($page);
                break;
            case 'projets':
                recupInfosProjets($page);
                break;
            case 'parcours':
                recupInfosParcours($page);
                break;
            case 'diplomes': 
                recupInfosDiplomes($page);
                break;
            case 'reseaux':    
                recupReseaux($page);
                break;
            case 'infos':
                recupInfos($page);
                break;
        }
    }

}

function recupInfosCV($page){

    global $cv, $adresse, $description, $nom, $prenom, $age;

    $jsonpage = $page->getJson();
    $cvJson = json_decode($jsonpage, true); 

    $adresse = $cvJson['adresse'];
    $description = $cvJson['presentation'];
    $nom = $cvJson['nom'];
    $prenom = $cvJson['prenom'];
    $age = $cvJson['age'];
    $cv = $cvJson["lienCv"];

}

function recupInfosCompetences($page){

    global $competences;

    $jsonPage           = $page->getJson();
    $competencesJson    = json_decode($jsonPage, true); //tableau de competences
    $tabCompetences     = $competencesJson['competences']; 

    $competences = array();

    foreach($tabCompetences as $competence){
        array_push($competences, new Competence($competence['nom'], $competence['description'], $competence['lien']));
    }
}

function recupInfosProjets($page){

    global $projets;

    $jsonPage       = $page->getJson();
    $projetsJson    = json_decode($jsonPage, true);
    $tabProjets     = $projetsJson['projets'];

    $projets = array();

    foreach($tabProjets as $projet){

        $img = "";

        if ( !isset($projet['image'])) {
            $img = "";
        } else {
            $img = $projet['image'];
        }

        array_push($projets, new Projet($projet['nom'], $projet['description'], $projet['taille'], trim(urldecode($projet['lien'])), $projet['image']));
    }
}

function recupInfosParcours($page){

    global $parcours;

    $jsonPage           = $page->getJson();
    $experiencesJson    = json_decode($jsonPage, true); //tableau d'experiences
    $tabExperiences     = $experiencesJson['parcours'];

    $parcours = array();

    foreach($tabExperiences as $experience) {
        array_push($parcours, new ExperiencePro($experience['nom'], $experience['entreprise'], $experience['dateDebut'] ,$experience['dateFin'], $experience['description']));
    }
}

function recupInfosDiplomes($page){

    global $diplomes;

    $jsonPage       = $page->getJson();
    $diplomesJson   = json_decode($jsonPage, true); //tableau de diplomes
    $tabDiplomes    = $diplomesJson['diplomes'];

    $diplomes = array();

    foreach($tabDiplomes as $diplome){
        array_push($diplomes, new Diplome($diplome['nom'], $diplome['etablissement'], $diplome['annee']));
    }
}

function recupReseaux($page){

    global $reseaux;

    $jsonPage       = $page->getJson();
    $reseauxJson   = json_decode($jsonPage, true);
    $tabReseaux    = $reseauxJson['reseaux'];

    $reseaux = array();

    foreach($tabReseaux as $reseau){
        $nomClasse = strtolower($reseau['nom']);
        array_push($reseaux, new Reseau($reseau['nom'], $nomClasse, $reseau['lien']));
    }


}

function recupInfos($page) {

    global $db, $nomPortfolio, $username, $mail, $descriptionSite, $descriptionReseau, $colorBck;

    $json = json_decode($page->getJson(), true);

    $mdpHash = $db->getMdp($username);
    $user = $db->getUser($username, $mdpHash);

    if ( key_exists("mail", $json)) {
        $mail = $json["mail"];
    }

    if ( key_exists("descriptionReseau", $json)) {
        $descriptionReseau = $json["descriptionReseau"];
    }

    if ( key_exists("descriptionSite", $json)) {
        $descriptionSite = $json["descriptionSite"];
    }

    if ( key_exists("bckCol", $json)) {
        $colorBck = $json["bckCol"];
    }

    $nomPortfolio = $json["nomPortfolio"];
}

?>