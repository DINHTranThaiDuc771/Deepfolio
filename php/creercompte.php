<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);

  require("../server/DB.inc.php");

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('location: accueil.php');
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUtilisateur = htmlSpecialChars($_POST["nomUtilisateur"]);
    $password       = htmlSpecialChars($_POST["password"]);
    $prenom     = htmlSpecialChars($_POST["prenom"]);
    $nom        = htmlSpecialChars($_POST["nom"]);
    $age        = htmlSpecialChars($_POST["age"]);
    $ville      = htmlSpecialChars($_POST["ville"]);
    $universite = htmlSpecialChars($_POST["universite"]);
    $mail       = htmlSpecialChars($_POST["mail"]);

    if ( $age == "") $age = 18;
    
    $DB = DB::getInstance();


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $DB->addUtilisateur($nomUtilisateur, $hashed_password);
    $DB->changePersonalInfo($nomUtilisateur, $nom, $prenom, $age, $ville, $universite, $mail);

    $user = $DB->getUser($nomUtilisateur, $hashed_password);


    $_SESSION["loggedin"] = true;
    $_SESSION["user"] = $user[0];

    //redirection accueil
    header('Location: accueil.php');
    exit();
  } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Création de compte - DeepFolio</title>
  <!-- MDB icon -->
  <link rel="icon" href="../img/favicon_io/android-chrome-512x512.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="../css/mdb.min.css" />
  <link rel="stylesheet" href="../css/creercompte.css" />
  <script src="../js/creercompte.js"></script>
</head>
</head>

<body>
  <section class="vh-100 ">
    <div class="container-fluid py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <form id="formCreerCompte" action="creercompte.php" method="POST" class="needs-avalidation" novalidate>

          <div class="card tab" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Créer un compte</h2>
                <p class="text-white-50 mb-5"></p>
                  <div class="form-outline mb-4">
                    <input type="text" name="nomUtilisateur" id="typeNomUtilisateur" class="form-control form-control-lg" required onkeypress="return noenter()"/>
                    <label class="form-label" for="typeNomUtilisateur">Nom d'utilisateur</label>
                    <div class="invalid-feedback">Veuillez entrer un Nom d'utilisateur</div>
                  </div>
                  
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" required onkeypress="return noenter()"/>
                    <label class="form-label" for="typePasswordX">Mot de passe</label>
                    <div class="invalid-feedback">Veuillez entrer un Mot de passe</div>
                  </div>

                  <button id="suivant" class="btn btn-primary btn-lg px-5 ml-2" type="button">Suivant</button>
              </div>
            </div>
          </div>

          <div class="card tab " style="border-radius: 1rem;">
            <div class="card-body p-5 text-center hiddenCards">
    
              <div class="mb-md-5 mt-md-4 pb-5 ">

                <h2 class="fw-bold mb-2 text-uppercase">Vos Informations</h2>
                <p class="text-white-50 mb-5"></p>

                <div class="form-outline mb-4">
                  <input type="prenom" name="prenom" id="typePrenom" class="form-control form-control-lg"  required/>
                  <label class="form-label" for="typePrenom">Prenom</label>
                  <div class="invalid-feedback">Veuillez entrer un Prenom</div>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="nom" id="typeNom" class="form-control form-control-lg"  required/>
                  <label class="form-label" for="typeNom">Nom</label>
                  <div class="invalid-feedback">Veuillez entrer un Nom</div>
                </div>

                <div class="form-outline mb-4">
                  <input type="number" name="age" min="0" max="120" id="typeAge" class="form-control form-control-lg" />
                  <label class="form-label" for="typeAge">Age</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" name="ville" id="typeVille" class="form-control form-control-lg" />
                  <label class="form-label" for="typeVille">Ville</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="universite" id="typeUniversite" class="form-control form-control-lg" />
                  <label class="form-label" for="typeUniversite">Universite</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="email" name="mail" id="typeMail" class="form-control form-control-lg" />
                  <label class="form-label" for="typeMail">Mail</label>
                </div>
                <button id="precedent" class="btn btn-secondary btn-lg px-5 mt-5" type="button">Précédent</button>
                <button class="btn btn-primary btn-lg px-5 ml-2" type="submit">Terminer</button>
              </div>
            </div>
          </div>
        </form>

        </div>
      </div>
    </div>
  </section>
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdbjs/mdb.min.js"></script>
    <!-- JQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../js/creercompte.js"></script>

    <script type="text/javascript">
      function noenter() {
        return !(window.event && window.event.keyCode == 13); }
    </script>
</body>

</html>
