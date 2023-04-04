<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);


    include("../server/DB.inc.php");

    session_start();

    $db;

    $db = DB::getInstance();

    if(isset($_POST['action'])) {
        if ($_POST['action'] == 'userExists') { userExists(); }
        if ($_POST['action'] == 'getPortfolios') { getPortfolios(); }
        if ($_POST['action'] == 'getMessages') { getMessages(); }
        if ($_POST['action'] == 'deleteMessage') { deleteMessage(); } 
        if ($_POST['action'] == 'deletePortfolio') { deletePortfolio(); }
    }

    if(isset($_POST['nom'])) {

        $nomE       = htmlspecialchars($_POST['nom']);
        $prenomE    = htmlspecialchars($_POST['prenom']);
        $mailE      = htmlspecialchars($_POST['mail']);
        $objet      = htmlspecialchars($_POST['objet']);
        $message   = htmlspecialchars($_POST['message']);

        $username = $_COOKIE['proprio_portfolio'];

        if($db->messageExists($username, $mailE) != 0 ){
            envoyerMessage($username, $mailE, $nomE, $prenomE, $objet, $message);           
        }else{
            updateMessage($username, $mailE, $nomE, $prenomE, $objet, $message);            
        }
        header("Location: ./visualisation.php");
    }



    function userExists() {
        $DB = DB::getInstance();
        $user = $_POST["username"];
        if(count($DB->userExists($user)) > 0) {
            echo "true";
        } else {
            echo "false";
        }   
    }

    function getPortfolios() {

        global $db;

        $user = $_SESSION["user"];
        $portfolios = $db->getPortfolios($user->getNomUtilisateur());
        echo json_encode($portfolios);
    }

    function getMessages() {

        global $db;

        $user = $_SESSION["user"];
        $messages = $db->getMessages($user->getNomUtilisateur());
        echo json_encode($messages);
    }

    function envoyerMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message) {

        global $db;

        return $db->envoyerMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message);
    }

    function updateMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message) {

        global $db;

        return $db->updateMessage($mail, $username, $nomEnvoyeur, $prenom, $objet, $message);
    }

    function deleteMessage() {
        $DB = DB::getInstance();
        $nomEnvoyeur = $_POST['nomUtilisateur'];
        $mailEnvoyeur = $_POST['mail'];
        $DB->deleteMessage($nomEnvoyeur, $mailEnvoyeur);
    }

    function deletePortfolio() {
        $DB = DB::getInstance();
        $user = $_SESSION["user"];
        $idPortfolio = $_POST['idPortfolio'];
        $DB->deletePortfolio($user->getNomUtilisateur(), $idPortfolio);
    }
?>