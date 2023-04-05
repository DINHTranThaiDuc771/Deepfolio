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
}

    $user = $_SESSION["user"];
    $prenom = $user->getPrenom();
    $nom = $user->getNom();
    $age = $user->getAge();
    $ville = $user->getVille();
    $mail = $user->getMail();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Création de Portfolio - DeepFolio</title>

    <!-- OUR icon -->
    <link rel="icon" href="../img/favicon_io/android-chrome-512x512.png" type="image/x-icon" />
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <!-- MDB icon -->
    <link rel="icon" href="../img/favicon_io/android-chrome-512x512.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <link rel="stylesheet" href="../css/formulaire.css" />
</head>

<body>  
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
                <a class="navbar-brand mt-2 mt-lg-0" href="accueil.php">
                    <img src="../img/logolong.png" height="50" alt="Logo" loading="lazy" />
                </a>

            </div>           

            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="col d-flex justify-content-end align-items-center">

                <div class="me-3">
                    <a class="fs-4 text" style="color: black"> <?php echo $user->getNomUtilisateur(); ?> </a>
                 </div>
                
                <!-- Avatar -->
                <div>  
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="profil.php"
                        id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                        <img src="../img/profil.png" class="rounded-circle" height="50"
                            alt="Image Profil" loading="lazy" />
                    </a>
                </div>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  <section class="vh-100 ">
    <div class="container-fluid py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <form id="formCreerPortfolio" autocomplete="off" action="creerPages.php" class="needs-avalidation" method="POST" novalidate>

                <div class="progress" style="height: 20px; border-radius: 1rem 1rem 0 0">
                    <div class="progress-bar" role="progressbar" id="progressbarPortfolio"  style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="card tab" style="border-radius: 0 0 1rem 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5"><!-- col-md-6 -->

                            <h2 class="fw-bold mb-2 text-uppercase unselectable">Informations</h2>
                            <div class="container" id="conteneur2Elements">
                                <div class="row">
                                    <div id="informationsGauche" class="col-md-6">
                                        <p class="text-white-50 mb-5"></p>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeNom" class="form-control form-control-lg <?php if ($nom != "") echo "active"; ?>" value=<?php echo "\"$nom\"";?> name="nom" required/>
                                            <label class="form-label unselectable" for="typeNom">Nom</label>
                                            <div class="invalid-feedback">Veuillez entrer un nom</div>
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typePrenom" class="form-control form-control-lg <?php if ($prenom != "") echo "active"; ?>" value=<?php echo "\"$prenom\"";?> name="prenom" required />
                                            <label class="form-label unselectable" for="typePrenom">Prénom</label>
                                            <div class="invalid-feedback">Veuillez entrer un prénom</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="number" min="13" id="typeAge" class="form-control form-control-lg <?php if ($age != "") echo "active"; ?>" name="age" value=<?php echo "\"$age\"";?> required />
                                            <label class="form-label" for="typeAge">Age</label>
                                            <div class="invalid-feedback">Veuillez entrer votre age</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="url" id="typeLienCv" class="form-control form-control-lg" name="lienCv" required />
                                            <label class="form-label" for="typeLienCv">Lien CV</label>
                                            <div class="invalid-feedback">Veuillez entrer un lien vers votre CV</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeResidence" class="form-control form-control-lg <?php if ($ville != "") echo "active"; ?>" value=<?php echo "\"$ville\"";?> name="adresse"/>
                                            <label class="form-label" for="typeResidence">Lieu de résidence</label>
                                            <div class="invalid-feedback">Veuillez entrer un lieu de résidence</div>
                                        </div>  
        
        
                                        <div class="form-outline mb-4">
                                            <textarea id="typePresentation" class="form-control form-control-lg" placeholder="Présentez vous en quelques lignes" name="presentation"required></textarea>
                                            <label class="form-label" for="typePresentation">Présentation</label>
                                            <div class="invalid-feedback">Veuillez vous présenter</div>
                                        </div>
                                    </div>

                                    <div id="informationsDroite" class="col-md-6">
                                        <p class="text-white-50 mb-5"></p>
                                        <div class="form-outline mb-4 autocomplete">                    
                                            <input type="text" id="typeReseau" list="lstReseaux" class="form-control form-control-lg require" />
                                            <datalist id="lstReseaux">
                                                <option class="lstReseaux" value="LinkedIn">
                                                <option class="lstReseaux" value="Facebook">
                                                <option class="lstReseaux" value="Discord">
                                                <option class="lstReseaux" value="Signal">
                                                <option class="lstReseaux" value="Telegram">
                                                <option class="lstReseaux" value="Stackoverflow">
                                                <option class="lstReseaux" value="Instagram">
                                                <option class="lstReseaux" value="Twitter">
                                                <option class="lstReseaux" value="GitHub">
                                                <option class="lstReseaux" value="Twitch">
                                                <option class="lstReseaux" value="Youtube">
                                            </datalist>
                                            <label class="form-label" for="typeReseau">Réseau</label>
                                            <div class="invalid-feedback">Veuillez entrer un réseau</div>
                                        </div>                                 
                                        
                                        <div class="form-outline mb-4">
                                            <input type="url" id="typeLien" class="form-control form-control-lg require"/>
                                            <label class="form-label" for="typeLien">Lien</label>
                                            <div class="invalid-feedback">Veuillez entrer un lien</div>
                                        </div>
                                        <a class="ajouter" type="button">Ajouter</a>
                                        <div class="fd-inline-flex p-2 tableauElmt" id="divReseaux">
        
                                        </div>
                                    </div>
                                </div>                
                            </div>
                            <button class="btn btn-primary btn-lg px-5 ml-2 suivant" type="button">Suivant</button>
                        </div>
                    </div>
                </div>

                <div class="card tab" style="border-radius: 0 0 1rem 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">

                            <h2 class="fw-bold mb-2 text-uppercase unselectable">Diplomes</h2>
                            <p class="text-white-50 mb-5"></p>

                            <div class="form-outline mb-4">
                                <input type="text" id="typeDiplome" class="form-control form-control-lg require" />
                                <label class="form-label" for="typeDiplome">Diplome</label>
                                <div class="invalid-feedback">Veuillez entrer un diplome</div>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="typeEtablissement" class="form-control form-control-lg require"  />
                                <label class="form-label" for="typeEtablissement">Etablissement</label>
                                <div class="invalid-feedback">Veuillez entrer l'établissement dans lequel vous avez obtenu ce diplôme</div>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="number" min="1950" max="2030" id="typeAnneeObtention" class="form-control form-control-lg require" />
                                <label class="form-label" for="typeAnneeObtention">Année d'obtention</label>
                                <div class="invalid-feedback">Veuillez entrer votre l'année d'obtention du diplome</div>
                            </div>
                            <a class="ajouter" type="button">Ajouter</a>
                            <div class="form-outline mb-4 tableauElmt" id="divDiplomes"></div>

                            <button class="btn btn-secondary btn-lg px-5 mt-5 precedent" type="button">Précédent</button>
                            <button class="btn btn-primary btn-lg px-5 ml-2 suivant" type="button">Suivant</button>

                        </div>
                    </div>
                </div>

                <!-- 3ème onglet: parcours professionnel -->
                <div class="card tab " style="border-radius: 0 0 1rem 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">

                            <h2 class="fw-bold mb-2 text-uppercase unselectable">Parcours professionnel</h2>
                            <p class="text-white-50 mb-5"></p>

                            <div class="form-outline mb-4">
                                <input type="text" id="typeEtablissement" class="form-control form-control-lg require"  />
                                <label class="form-label" for="typeEtablissement">Poste</label>
                                <div class="invalid-feedback">Veuillez entrer le nom du poste que vous avez occupé</div>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="text" id="typeEntreprise" class="form-control form-control-lg require"  />
                                <label class="form-label" for="typeEntreprise">Entreprise</label>
                                <div class="invalid-feedback">Veuillez entrer une entreprise</div>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="date" id="typeDateDebut" class="form-control form-control-lg active require"  />
                                <label class="form-label" for="typeDateDebut">Date de début</label>
                                <div class="invalid-feedback">Veuillez entrer une date de début</div>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="date" id="typeDateFin" class="form-control form-control-lg active require"  />
                                <label class="form-label" for="typeDateFin">Date de Fin</label>
                                <div class="invalid-feedback">Veuillez entrer une date de fin</div>
                            </div>
                            <div class="form-outline mb-4">
                                <textarea id="typeDescriptionPoste" class="form-control form-control-lg require"></textarea>
                                <label class="form-label" for="typeDescriptionPoste">Description</label>
                                <div class="invalid-feedback">Veuillez entrer une description</div>
                            </div>
                            <a class="ajouter" type="button">Ajouter</a>

                            <div class="form-outline mb-4 tableauElmt" id="divEntreprises"></div>

                            <button class="btn btn-secondary btn-lg px-5 mt-5 precedent" type="button">Précédent</button>
                            <button class="btn btn-primary btn-lg px-5 ml-2 suivant" type="button">Suivant</button>

                        </div>
                    </div>
                </div>

                <!-- 4ème onglet: Projets -->
                <div class="card tab " style="border-radius: 0 0 1rem 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">                            
                            <h2 class="fw-bold mb-2 text-uppercase unselectable">Projets</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-white-50 mb-5"></p>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="typeNomProjet" class="form-control form-control-lg require"  />
                                        <label class="form-label" for="typeNomProjet">Nom du projet</label>
                                        <div class="invalid-feedback">Veuillez entrer le nom du poste que vous avez occupé</div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="typeDescProjet" class="form-control form-control-lg require"  />
                                        <label class="form-label" for="typeDescProjet">Description</label>
                                        <div class="invalid-feedback">Veuillez entrer la description du poste que vous avez occupé</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <p class="text-white-50 mb-5"></p>
                                    <div class="form-outline mb-4">
                                        <input type="number" id="typeTailleEquipe" class="form-control form-control-lg require"  />
                                        <label class="form-label" for="typeTailleEquipe">Taille de l'équipe</label>
                                        <div class="invalid-feedback">Veuillez entrer la taille de l'équipe</div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="url" id="typeLienProjet" class="form-control form-control-lg"  />
                                        <label class="form-label" for="typeLienProjet">Lien du projet</label>
                                        <div class="invalid-feedback">Veuillez entrer le lien vers le projet</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-outline mb-4 col-md-10">
                                    <input type="file" accept=".jpg, .jpeg, .png, .svg" id="typePhotoprojet" class="form-control form-control-lg"  />
                                    <label class="form-label" for="typePhotoprojet"></label>
                                    <div class="invalid-feedback">Veuillez entrer une photo</div>
                                </div>
                                <div class="col-md-2">
                                    <a class="ajouter" type="button">Ajouter</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-outline mb-4 tableauElmt col-md-12"></div>
                            </div>     

                            <button class="btn btn-secondary btn-lg px-5 mt-5 precedent" type="button">Précédent</button>
                            <button class="btn btn-primary btn-lg px-5 ml-2 suivant" type="button">Suivant</button>

                        </div>
                    </div>
                </div>

                <!-- 5ème onglet: Compétences -->
                <div class="card tab " style="border-radius: 0 0 1rem 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">

                            <h2 class="fw-bold mb-2 text-uppercase">Ajouter des compétences</h2>
                            <p class="text-white-50 mb-5"></p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-outline mb-4 ">
                                        <input type="text" id="typeCompetence" class="form-control form-control-lg require"  />
                                        <label class="form-label" for="typeCompetence">Nom de la compétence</label>
                                        <div class="invalid-feedback">Veuillez entrer le nom d'une compétence</div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="typeDescCompetence" class="form-control form-control-lg require"  />
                                        <label class="form-label" for="typeDescCompetence">Description</label>
                                        <div class="invalid-feedback">Veuillez entrer la description de la compétence</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-outline mb-4">
                                        <input type="url" id="lienNonProjet" class="form-control form-control-lg"  />
                                        <label class="form-label" for="lienNonProjet">Lien</label>
                                        <div class="invalid-feedback">Veuillez entrer un lien</div>
                                    </div>

                                    <div class="form-floating form-outline mb-4">
                                        <select class="form-select" id="lienProjet" aria-label="Floating label select example">
                                        </select>
                                        <label for="floatingSelect">Lier un projet</label>
                                    </div>                                 
                                
                                </div>                                                 
                            </div>                       
                            <a class="ajouter" type="button">Ajouter</a>

                            <div class="form-outline mb-4 tableauElmt col-md-12"></div>

                            <div class="row mt-5">
                                <div class="col-md-6">
                                <div class="form-outline mb-1">
                                        <input type="text" id="nomPortfolio" class="form-control form-control-lg"  name="nomPortfolio"/>
                                        <label class="form-label" for="nomPortfolio">Nom du portfolio</label>
                                        <div class="invalid-feedback">Veuillez entrer un nom pour ce portfolio</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mt-2">
                                            <input type="checkbox" id="accesible" class="form-check-input"  name="accesible"/>
                                            <label class="form-check-label" for="accesible">Accessible</label>
                                            <div class="invalid-feedback">Veuillez entrer une visibilité</div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-secondary btn-lg px-5 mt-2 precedent" type="button">Précédent</button>
                            <button class="btn btn-primary btn-lg px-5 ml-2" type="submit">Terminer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </section>
    <script>
        document.querySelectorAll('.form-outline').forEach((formOutline) => {
            new mdb.Input(formOutline).init();
        });
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="../js/mdbjs/mdb.min.js"></script>
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- jQuery Cookie plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- our script -->
    <script type="text/javascript" src="../js/formulaire.js"></script>
    
</body>

</html>