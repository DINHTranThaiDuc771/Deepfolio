<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../server/DB.inc.php';
require_once "../../Twig/lib/Twig/Autoloader.php";

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

        //switch($typePage)
    }

    }

?>