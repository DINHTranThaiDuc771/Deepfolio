<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../server/DB.inc.php';
require_once "../Twig/lib/Twig/Autoloader.php";
require '../server/Competence.inc.php';
require '../server/Projet.inc.php';
require '../server/Diplome.inc.php';
require '../server/ExperiencePro.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user'])){
    header("Location: connexion.php");
    exit();
}

if(!isset($_GET['cle'])){
    header("Location: accueil.php");
    exit();
}


//------------ Variables globales ------------//
$nomportfolio; $adresse; $mail;
$reseaux; $description; $nom;
$prenom; $age; $competences; 
$projets; $parcours; $diplomes;

Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("../templates"));


$cle = $_GET['cle'];

$cle = base64_decode($cle);

$jsonCle = json_decode($cle);

$username = $jsonCle->auteur;
$idPortfolio = $jsonCle->idPortfolio;

$db = DB::getInstance();

affichePages($username, $idPortfolio, $db);

$tpl = $twig->loadTemplate( "tplVisu.tpl" );

echo $tpl->render(array(
    //'nomportfolio' => $nomportfolio,
    'ville' => $adresse,
    //'mail' => $mail,
    'reseaux' => $reseaux,
    'description' => $description,
    'competences' => $competences,
    'prenom' => $prenom,
    'nom' => $nom,
    'age' => $age,
    'projets' => $projets,
    'postes' => $parcours,
    'diplomes' => $diplomes
));
        
function affichePages($username, $idPortfolio, $db){
    
    $pages = $db->getPages($username, $idPortfolio);

    foreach($pages as $page) {

        $typePage = $page->getType();

        switch($typePage){
            case 'cv':
                //TODO: recuperer les infos
                recupInfosCV($page);
                break;
            case 'competences':
                //TODO: recuperer les infos
                recupInfosCompetences($page);
                break;
            case 'projets':
                //TODO: recuperer les infos
                recupInfosProjets($page);
                break;
            case 'parcours':
                //TODO: recuperer les infos
                recupInfosParcours($page);
                break;
            case 'diplomes':
                //TODO: recuperer les infos
                recupInfosDiplomes($page);
                break;
        }
    }

}

function recupInfosCV($page){

    global $adresse, $reseaux, $description, $nom, $prenom, $age;

    $jsonpage = $page->getJson();
    $cvJson = json_decode($jsonpage, true); //array avec les infos du cv

    //$nomportfolio = $cvJson['nomportfolio'];
    $adresse = $cvJson['adresse'];
    //$mail = $cvJson['mail'];
    $reseaux = $cvJson['reseaux'];
    $description = $cvJson['presentation'];
    $nom = $cvJson['nom'];
    $prenom = $cvJson['prenom'];
    $age = $cvJson['age'];
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
    $projetsJson    = json_decode($jsonPage, true); //tableau de projets
    $tabProjets     = $projetsJson['projets'];

    $projets = array();

    foreach($tabProjets as $projet){
        array_push($projets, new Projet($projet['nom'], $projet['description'], $projet['taille'], $projet['lien'], $projet['image']));
    }
}

function recupInfosParcours($page){

    global $parcours;

    $jsonPage           = $page->getJson();
    $experiencesJson    = json_decode($jsonPage, true); //tableau d'experiences
    $tabExperiences     = $experiencesJson['parcours'];

    $parcours = array();

    foreach($tabExperiences as $experience){
        array_push($parcours, new ExperiencePro($experience['nom'], $experience['entreprise'], $experience['description'], $experience['dateDebut'] ,$experience['dateFin']));
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

?>