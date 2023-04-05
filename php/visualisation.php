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

if(!isset($_GET['cle'])){
    header("Location: accueil.php");
    exit();
}


Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("../templates"));


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


Twig_Autoloader::register();
$twig = new Twig_Environment( new Twig_Loader_Filesystem("../templates"));


//------------ Variables globales ------------//
$nomPortfolio; 
$adresse; 
$mail;
$reseaux; 
$description; 
$nom;
$prenom; 
$age; 
$competences; 
$projets; 
$parcours; 
$diplomes;
//------------ Variables globales ------------//



setcookie('proprio_portfolio', $username, []);


affichePages($username, $idPortfolio, $db);

$tpl = $twig->loadTemplate( "tplVisu.tpl" );

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
    'cle' => $cle
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
            case 'infos':
                //TODO: recuperer les infos
                recupInfos($page);
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
        $img = "";
        if ( !isset($projet['image'])) {
            $img = "";
        } else {
            $img = $projet['image'];
        }
        array_push($projets, new Projet($projet['nom'], $projet['description'], $projet['taille'], $projet['lien'], ));
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

function recupInfos($page) {

    global $db, $nomPortfolio, $username, $mail;

    $json = json_decode($page->getJson());

    $mdpHash = $db->getMdp($username);
    $user = $db->getUser($username, $mdpHash);

    $mail = $user[0]->getMail();
    $nomPortfolio = $json->nomPortfolio;
}

?>