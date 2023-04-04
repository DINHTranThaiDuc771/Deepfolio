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
if(!isset($_SESSION["loggedin"])){
    header('location: connexion.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $user = $_SESSION["user"];
  $prenom     = htmlSpecialChars($_POST["prenom"]);
  $nom        = htmlSpecialChars($_POST["nom"]);
  $age        = htmlSpecialChars($_POST["age"]);
  $ville      = htmlSpecialChars($_POST["ville"]);
  $mail       = htmlSpecialChars($_POST["mail"]);

  if ( $age == "" || $age == null) $age = 18;

  $db = DB::getInstance();

  $db->changePersonalInfo($user->getNomUtilisateur(), $nom, $prenom, $age, $ville, $user->getUniversite(), $mail);

}



function formulaire(){
    $db = DB::getInstance();

    $user = $_SESSION["user"];
    $user = $db->getUser($user->getNomUtilisateur(), $user->getMdp())[0];
    $_SESSION["user"] = $user;

    $prenom = $user->getPrenom();
    $nom = $user->getNom();
    $age = $user->getAge();
    $ville = $user->getVille();
    $mail = $user->getMail();

    echo"
            <form action=\"profil.php\" method=\"POST\">
                <div class=\"form-outline mb-4 \">
                <input name=\"prenom\" type=\"text\" id=\"modifPrenom\" class=\"form-control active\" value=\"$prenom\"/>
                <label class=\"form-label\" for=\"modifPrenom\">Prenom</label>
            </div>

            <div class=\"form-outline mb-4\">
                <input name=\"nom\" type=\"text\" id=\"typeNom\" class=\"form-control form-control-lg active\" value=\"$nom\"/>
                <label class=\"form-label\" for=\"typeNom\">Nom</label>
            </div>

            <div class=\"form-outline mb-4\">
                <input name=\"age\" type=\"text\" id=\"typeAge\" class=\"form-control form-control-lg active\" value=\"$age\"/>
                <label class=\"form-label\" for=\"typeAge\">Age</label>
            </div>

            <div class=\"form-outline mb-4\">
                <input name=\"ville\" type=\"text\" id=\"typeVille\" class=\"form-control form-control-lg active\" value=\"$ville\"/>
                <label class=\"form-label\" for=\"typeVille\">Ville</label>
            </div>

            <div class=\"form-outline mb-4\">
                <input name=\"mail\" type=\"email\" id=\"typeMail\" class=\"form-control form-control-lg active\" value=\"$mail\"/>
                <label class=\"form-label\" for=\"typeMail\">Mail</label>
            </div>
                <button class=\"btn btn-primary btn-lg px-5 ml-2\" type=\"submit\">Enregistrer</button>
            </div>
            </form>";
}

?>  



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Profile</title>

  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="../css/mdb.min.css" />
  <link rel="stylesheet" href="../css/profil.css" />

</head>

<body>
  <!-- Start your project here-->


  <!-- Sidebar -->
  <!-- Toggle button-->

  <!-- Toggle button-->
  <div class="container mt-5">
    <a href="#" id="icon-toggle-menu">
      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd"
          d="M4.5 27H31.5V24H4.5V27ZM4.5 19.5H31.5V16.5H4.5V19.5ZM4.5 9V12H31.5V9H4.5Z" fill="black"
          fill-opacity="0.87" />
      </svg>
  
    </a>
    <div id="sidebar" class="sidebar">

      <div id="img-nom">
        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg" class="svg">
          <circle cx="50.5" cy="50.5" r="50.5" fill="#FFD285" />
        </svg>
        <h2 style="text-align: center;"> <?php echo $_SESSION["user"]->getNomUtilisateur() ?></h2>
      </div>
      <div id="list-infos" style="list-style: none;">
        <li>
          <ul><a id="btn-profil" href="#">Profil</a></ul>
          <ul><a id="btn-portfolios" href="#">Vos portfolios</a></ul>
          <ul>
            <form action="deconnexion.php" method="get">
              <input type="submit" value="Se Deconnexion" class="btn btn-primary">
            </form>
          </ul>
        </li>
      </div>
    </div>
    <!-- Sidenav -->

    <!-- Info tab -->
    <div class="container-custom">
      <div id="tab-profil" class="row" style="border-radius: 1rem;">

        <div class="mb-md-5 mt-md-4 col-md-6 p-5">

          <h2 class="fw-bold mb-2 text-uppercase">Votre profil</h2>
          <p class="text-white-50 mb-5"></p>
            <?php formulaire() ?>

        <div id="profil-img" class="col-md-6 p-5">
          <svg width="210" height="210" viewBox="0 0 210 210" fill="none" xmlns="http://www.w3.org/2000/svg"  class="svg">
            <circle cx="105" cy="105" r="105" fill="#FFD285" />
          </svg>
        </div>
      </div>

      <div id="tab-portfolio" class="container" style="padding: 50px">
        <h1 style="margin-bottom: 30px">Vos portfolios</h1>

          

      </div>
    </div>
  </div>
  <!-- Info tab -->
  <div id="logo-home">
    <a href="accueil.php">
      <img src="../img/logolong.png" alt="logo" width="274" height="67"/>
    </a>
  </div>

  <!-- JQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="../js/profil.js"></script>

  <?php echo "<script> changerSvg(\"" . $_SESSION["user"]->getNomUtilisateur() . "\"); </script>" ?>
</body>
</body>

</html>

