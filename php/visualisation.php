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

$cle = $_GET['cle'];

$cle = base64_decode($cle);

$jsonCle = json_decode($cle);

$username = $jsonCle->auteur;
$idPortfolio = $jsonCle->idPortfolio;


    //-----------------------------------------//
    //                 TWIG                    //
    //-----------------------------------------//

    Twig_Autoloader::register();
    $twig = new Twig_Environment( new Twig_Loader_Filesystem("./tpl2"));


$db = DB::getInstance();

affichePages($username, $idPortfolio, $db);

function affichePages($username, $idPortfolio, $db){
    
    $pages = $db->getPages($username, $idPortfolio);

    foreach($pages as $page) {
        //var_dump($page);
    }

    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Portfolio A</title>
        <!-- MDB icon -->
        <link rel="icon" href="../img/mdb-favicon.ico" type="image/x-icon" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <!-- Google Fonts Roboto -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
        <!-- MDB -->
        <link rel="stylesheet" href="../css/mdb.min.css" />
        <link rel="stylesheet" href="../css/visualisation.css" />

    </head>

    <body>
        <!-- Start your project here-->
        <!------------------->
        <!--NavBar ---------->
        <!------------------->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->

            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                    <!-- Left links -->
                    <img id="logo-nav" src="..\img\favicon_io\logo-79x76.png" alt="">
                    <div style="margin-left: 20px;">
                        <h1 class="editableText">Portfolio A</h1>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a id="linkAccueil"class="nav-link active" aria-current="page" href="#">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a id="linkCompetences"class="nav-link active" href="#">Compétences</a>
                            </li>

                            <li class="nav-item">
                                <a id="linkProjets"href="#" class="nav-link active">Projets</a>
                            </li>

                            <li class="nav-item">
                                <a id="linkCV"href="#" class="nav-link active">CV</a>
                            </li>

                            <li class="nav-item">
                                <a id="linkContact"href="#" class="nav-link active">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div id="btnEditer"class="col d-flex justify-content-end">
                        <a href="#">
                            <img src="..\img\favicon_io\editer.png" alt="">
                        </a>

                    </div>


                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!------------------->
        <!--NavBar ---------->
        <!------------------->



        <!------------------->
        <!--Accueil---------->
        <!------------------->

        <div id="pageAccueil" class=" container-fluid">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center">
                    <p  class="editableText" id="quote">"La vie est un mystère qu'il faut vivre, et non un problème à résoudre."</p>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <img id="hero-image" src="..\img\favicon_io\hero-image.jpg" alt="hero-image">
                </div>
            </div>
        </div>
        <!------------------->
        <!--Accueil---------->
        <!------------------->


        <!------------------->
        <!-- Mes compétences-->
        <!------------------->

        <div id="pageCompetences"class="container-fluid tab">
            <section class="content ">
                <h1 class="editableText">Elaborer des conceptions simples</h1>
                <article  class="editableText">
                    <div class="left">
                        <ul>
                            <li>Je sais construire UML diagram (en respectant les normes grâce à uml-diagrams.org)</li>
                            <li>Je sais utiliser Github pour gerer les versions de mon projet</li>
                        </ul>
                    </div>

                </article>
            </section>
            <section class="content ">
                <h1  class="editableText">Elaborer des conceptions simples</h1>
                <article  class="editableText">
                    <div class="left">
                        <ul>
                            <li>Je sais construire UML diagram (en respectant les normes grâce à uml-diagrams.org)</li>
                            <li>Je sais utiliser Github pour gerer les versions de mon projet</li>
                        </ul>
                    </div>

                </article>
            </section>
        </div>
        <!------------------->
        <!--Mes compétences-->
        <!------------------->

        <!------------------->
        <!--    Projets------>
        <!------------------->
        <div id="pageProjets" class="container-fluid tab">
            <div class="row">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    <img src="..\img\favicon_io\android-chrome-192x192.png" alt="">
                </div>
                <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">
                    <p class="editableText">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in
                        culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>


            <div class="row">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    <img src="..\img\favicon_io\android-chrome-192x192.png" alt="">
                </div>
                <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">
                    <p class="editableText">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in
                        culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>
        </div>

        <!------------------->
        <!--    Projets ----->
        <!------------------->

        <!------------------->
        <!--    CV     ------>
        <!------------------->
        <div id="pageCV"class="tab container justify-content-center">
            <div class="row mb-2">
                <h1 class="editableText">Prénom nom</h1>
            </div>
            <hr>
            <div class="row">
                <h2>Profil</h2>
                <p class="editableText">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor in r adipiscing e r
                    adipiscing e o eiusmoo eiusmo.
                </p class="editableText">
            </div>
            <hr>
            <div class="row  mb-2">
                <h2>Compétences</h2>
                <li style="list-style: none;">
                    <ul class="editableText">Compétence 1</ul>
                    <ul class="editableText">Compétence 2</ul>
                    <ul class="editableText">Compétence 3</ul>
                </li>
            </div>
            <hr>
            <div class="row  mb-2">
                <h2>Projet</h2>
                <li style="list-style: none;">
                    <ul>
                        <h3 class="editableText">Nom du projet A</h3>
                        <p class="editableText">Description</p>
                    </ul>
                    <ul>
                        <h3 class="editableText">Nom du projet B</h3>
                        <p class="editableText">sum dolor sit amet, consectetur sum dolor sit amet, consectetur sum dolor sit amet, consectetur
                            sum dolor sit amet, consectetur </p>
                    </ul>
                    <ul>
                        <h3 class="editableText">Nom du projet C</h3>
                        <p class="editableText">Descrition</p>
                    </ul>
                </li>
            </div>
            <hr>
            <div class="row  mb-2">
                <h2>Expérience</h2>
                <li style="list-style: none;">
                    <ul>
                        <h3 class="editableText">Nom Poste et Entreprise</h3>
                        <p class="editableText">Description</p>
                    </ul>
                    <ul>
                        <h3 class="editableText">Dévélopeur JS</h3>
                        <p class="editableText">sum dolor sit amet, consectetur sum dolor sit amet, consectetur sum dolor sit amet, consectetur
                            sum dolor sit amet, consectetur </p>
                    </ul>
                    <ul>
                        <h3 class="editableText">Dévélopeur PHP</h3>
                        <p class="editableText">Descrition</p>
                    </ul>
                </li>
            </div>
            <hr>
            <div class="row  mb-2">
                <h2>Parcours Académique</h2>
                <li style="list-style: none;">
                    <ul>
                        <h3 class="editableText">Nom d'établissment</h3>
                        <p class="editableText">Description</p>
                    </ul>
                </li>
            </div>
            <button class="btn btn-primary btn-lg px-5 ml-2  mb-4">Télécharger</button>
        </div>
        <!------------------->
        <!--    Contact------>
        <!------------------->
        <div id="pageContact"class="tab">
            <section class="vh-100 ">
                <div class="container-fluid py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <form id="formCreerCompte" action="accueil.html" class="needs-avalidation" novalidate>

                                <div class="card " style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">

                                        <div class="mb-md-5 mt-md-4 pb-5">

                                            <h2 class="fw-bold mb-4 text-uppercase">Contact</h2>
                                            <div class="form-outline mb-4">
                                                <input type="text" id="typeNomUtilisateur"
                                                    class="form-control form-control-lg" required
                                                    onkeypress="return noenter()" />
                                                <label class="form-label" for="typeNomUtilisateur">Prénom</label>
                                                <div class="invalid-feedback">Veuillez entrer un Nom d'utilisateur</div>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="typeNom" class="form-control form-control-lg"
                                                    required onkeypress="return noenter()" />
                                                <label class="form-label" for="typeNom">Nom</label>
                                                <div class="invalid-feedback">Veuillez entrer un Mot de passe</div>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="email" id="typeMail" class="form-control form-control-lg"
                                                    required onkeypress="return noenter()" />
                                                <label class="form-label" for="typeMail">Mail</label>
                                                <div class="invalid-feedback">Veuillez entrer votre addresse mail</div>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <input type="text" id="typeObjet" class="form-control form-control-lg"
                                                    required onkeypress="return noenter()" />
                                                <label class="form-label" for="typeObjet">Objet</label>
                                                <div class="invalid-feedback">Veuillez entrer votre Objet de message</div>
                                            </div>

                                            <div class="form-outline shadow-textarea mb-4">
                                                <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6"
                                                    rows="3" placeholder="Message"></textarea>
                                            </div>

                                            <button id="envoyer" class="btn btn-primary btn-lg px-5 ml-2"
                                                type="submit">Envoyer</button>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!------------------->
        <!--    Contact------>
        <!------------------->









        <!-- End your project here-->

        <!-- MDB -->
        <script type="text/javascript" src="../js/mdbjs/mdb.min.js"></script>
        <!-- Custom scripts -->
        <script type="text/javascript" src="../js/visualisation.js">
        </script>
    </body>
    </body>

    </html>