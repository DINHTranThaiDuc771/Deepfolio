<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Connexion - DeepFolio</title>
    <!-- MDB icon -->
    <link rel="icon" href="../img/favicon_io/android-chrome-512x512.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/connexion.css" />
    <!-- JS -->
    <script src="../js/defile.js"></script>
  </head>
  </head>
  <body>
    <!-- Start your project here-->
    <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">
    
                    <div class="text-center">
                      <img src="../img/logo.png"
                        style="width: 185px;" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1"></h4>
                    </div>
    
                    <form class="needs-validation" action="connexion.php" method="POST" novalidate>
    
						<div class="form-outline mb-4">
							<input type="text" id="form2Example11" class="form-control"  placeholder="Au moins 5 caractère" name='username' required/>
							<label class="form-label" for="form2Example11">Nom d'utilisateur</label>
							<div class="invalid-feedback">Veuillez entrer un nom d'utilisateur</div>
						</div>
		
						<div class="form-outline mb-4">
							<input type="password" id="form2Example22" class="form-control" name='password' required/>
							<label class="form-label" for="form2Example22">Mot de passe</label>
							<div class="invalid-feedback">Veuillez entrer un mot de passe</div>
						</div>
		
						<div class="text-center pt-1 mb-5 pb-1">
							<button class="btn btn-primary btn-block fa-lg btn-custom-2 mb-3" type="submit">Se connecter</button>
						</div>

						<span class="alert alert-dark" role="alert" style="display:none;">
							Mauvais nom d'utilisateur ou mot de passe
						</span>
    
						<div class="d-flex align-items-center justify-content-center pb-4">
							<p class="mb-0 me-2">Pas de compte?</p>
							<button type="button" class="btn btn-outline-dark" onclick="window.location.href='creercompte.php'">Créer un compte</button>
						</div>
    
                    </form>
    
                  </div>
                </div>
                
                <div id='divImg' class="col-lg-6 d-flex align-items-center slider justify-content-center">  
                  <a type="button" id='previous'> &lt </a>
                  <a type="button" id='next'> &gt </a>        
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script type="text/javascript" src="../js/mdbjs/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require '../server/DB.inc.php';
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
    
    $username = htmlspecialchars(trim($_POST["username"]));   
    $password = htmlspecialchars(trim($_POST["password"]));
    
    $DB = DB::getInstance();

    if($DB->userExists($username)){
        $mdp = $DB->getMdp($username);

        if (password_verify($password, $mdp)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: accueil.php");
        }else{
            //echo'<script> displayAlert() </script>';
        }
    }else{
        $login_err = "Nom inconnu";
    }

}

?>