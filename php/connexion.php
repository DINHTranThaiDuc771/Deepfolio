<?php

require './server/DB.inc.php';
// Initialize the session

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('location: accueil.php');
    exit;
}
 
 
// Define variables and initialize with empty values
$username = $password = $status = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    $username = trim($_POST["username"]);   
    $password = trim($_POST["password"]);
    
    $DB = DB::getInstance();

    if($DB->userExists($username)){
        $mdp = $DB->getMdp($username);

        if (password_verify($password, $haskey)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: accueil.php");
        }else{
            $login_err = "Mauvais mot de passe";
        }
    }else{
        $login_err = "Nom inconnu";
    }

}

?>


