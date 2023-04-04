<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../server/DB.inc.php';
require_once "../Twig/lib/Twig/Autoloader.php";

session_start();

if(!isset($_SESSION['user'])){
    header("Location: connexion.php");
    exit();
}

if(!isset($_GET['cle'])){
    header("Location: accueil.php");
    exit();
}

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
        
echo $tpl->render(array());

function affichePages($username, $idPortfolio, $db){
    
    $pages = $db->getPages($username, $idPortfolio);

    foreach($pages as $page) {

        var_dump($page);
        //$typePage = $page
        /*
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
        */
    }

}

function recupInfosCV($page){
    $jsonpage = $page['jsonPage'];
}

function recupInfosCompetences($page){

    $jsonPage       = $page['jsonPage'];
    $competences    = $jsonPage->competences; //tableau de competences

    foreach($competences as $competence){
       new Competence($competence->nom, $competence->description, $competence->lien);
    }
}

function recupInfosProjets($page){

    $jsonPage       = $page['jsonPage'];
    $projets        = $jsonPage->projets; //tableau de projets

    foreach($projets as $projet){
        new Projet($projet->nom, $projet->description, $projet->taille, $projet->lien, $projet->image);
    }

}

function recupInfosParcours($page){

    $jsonPage       = $page['jsonPage'];
    $experiences    = $jsonPage->parcours; //tableau d'experiences

    foreach($experiences as $experience){
        new ExperiencePro($experience->nom, $experience->entreprise, $experience->description, $experience->dateDebut ,$experience->dateFin);
    }

}

function recupInfosDiplomes($page){

    $jsonPage   = $page['jsonPage'];
    $diplomes   = $jsonPage->diplomes; //tableau de diplomes

    foreach($diplomes as $diplome){
        new Diplome($diplome->nom, $diplome->etablissement, $diplome->annee);
    }

}

?>