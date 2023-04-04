<?php
    include("../server/DB.inc.php");

    session_start();

    if(isset($_POST['action'])) {
        if ($_POST['action'] == 'userExists') { userExists(); }
        if ($_POST['action'] == 'getPortfolios') { getPortfolios(); }
        if ($_POST['action'] == 'getMessages') { getMessages(); }
    }

    function userExists() {
        $DB = DB::getInstance();
        $user = $_SESSION["user"];
        if(count($DB->userExists($user->getNomUtilisateur())) > 0) {
            echo "true";
        } else {
            echo "false";
        }   
    }

    function getPortfolios() {
        $DB = DB::getInstance();
        $user = $_SESSION["user"];
        $portfolios = $DB->getPortfolios($user->getNomUtilisateur());
        echo json_encode($portfolios);
    }

    function getMessages() {
        $DB = DB::getInstance();
        $user = $_SESSION["user"];
        $messages = $DB->getMessages($user->getNomUtilisateur());
        echo json_encode($messages);
    }
?>