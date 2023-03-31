<?php
    include("../server/DB.inc.php");

    session_start();

    if(isset($_POST['action'])) {
        if ($_POST['action'] == 'userExists') { userExists(); }
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
?>