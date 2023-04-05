<!DOCTYPE html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../server/DB.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  

if (!isset($_SESSION["loggedin"]) && !isset($_SESSION["user"])) {
    header('location: ./connexion.php');
}else{
    $DB = DB::getInstance();    

    $user = $_SESSION["user"];

    $listePortfolios = $DB->getPortfolios($user->getNomUtilisateur());
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Accueil - DeepFolio</title>
          <!-- OUR icon -->
        <link rel="icon" href="../img/favicon_io/android-chrome-512x512.png" type="image/x-icon" />
        <!-- Bootstrap CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <!-- Bootstrap JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="../css/mdb.min.css" />
        <link rel="stylesheet" href="../css/accueil.css" />
        
    </body>

    </head>

    <body>
        <!-- Start your project here-->
        
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="col " id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <img src="../img/email.png" id="btnMail" height="30" alt="Messagerie" loading="lazy" />
                        <img src="../img/logolong.png" height="30" alt="Logo" loading="lazy" />
                    </a>

                </div>

                <!-- Bar Recherche -->
                <div class="col d-flex justify-content-center input-group rounded w-50">
                    <input id="search-bar" type="search" class="form-control rounded" placeholder="Rechercher un Portfolio" aria-label="Search"
                        aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                

                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="col d-flex justify-content-end align-items-center">

                    <div class="me-3">
                        <a class="fs-4 text" style="color: black"><?php echo 'Bonjour '.$user->getNomUtilisateur().' !';?></a>                        
                    </div>
                    
                    <!-- Avatar -->
                    <div>  
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="profil.php"
                            id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                            <img src="../img/profil.png" class="rounded-circle" height="30"
                                alt="Image Profil" loading="lazy" />
                        </a>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <div class="container mt-5">
            <div id="sidebar" class="sidebar">
                <button id="btnCloseSideBar" type="button" class="btn-close" aria-label="Close"></button>

                <h3 style="text-align: center;">Messagerie</h3>

                <div id="messages">
                </div>

            </div>

            <div id="portfolios" class="row my-5">
            </div>
        </div>

        <!-- End your project here-->

    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdbjs/mdb.min.js"></script>
    <!-- JQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- JSON Stringify -->
    <script type="text/javascript" src="https://github.com/douglascrockford/JSON-js/blob/master/json2.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../js/accueil.js"></script>
</body>

</html>