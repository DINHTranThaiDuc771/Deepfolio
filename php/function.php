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
        $username = htmlspecialchars($_POST["username"]);
        if(count($DB->userExists($username)) > 0) {
            echo "true";
        } else {
            echo "false";
        }   
    }

    function getPortfolios() {
        $DB = DB::getInstance();
        $username = htmlspecialchars($_SESSION["username"]);
        $portfolios = $DB->getPortfolios($username);
        echo json_encode($portfolios);
    }

    function getMessages() {
        $DB = DB::getInstance();
        $username = htmlspecialchars($_SESSION["username"]);
        $messages = $DB->getMessages($username);
        echo json_encode($messages);
    }
?>