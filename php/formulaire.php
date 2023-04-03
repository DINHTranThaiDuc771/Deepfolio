<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require '../server/DB.inc.php';
require 'creerPages.php';

session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    if (isset($_POST['submit'])) {
        $portfolio_cookie =  html_entity_decode($_COOKIE['portfolio']);
        $portfolio_json = json_decode($portfolio_cookie);

        $username = $_SESSION['username'];
        $nomPortfolio = $_POST['nomPortfolio'];
        $accessible  = $_POST['accessible'];


        $DB = DB::getInstance();

        $result = $DB->addPortfolio($username, $nomPortfolio, $accessible);
        if($result) {
            echo "Portfolio créé avec succès";
            creerPages($portfolio_json);
        }
        else {
            echo "Erreur lors de la création du portfolio";
        }
    }  
}else{
    header("Location: connexion.php");    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Création de compte - DeepFolio</title>

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
  <section class="vh-100 ">
    <div class="container-fluid py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <form id="formCreerPortfolio" action="accueil.html" class="needs-avalidation" novalidate>

                <div class="card tab" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5"><!-- col-md-6 -->

                            <h2 class="fw-bold mb-2 text-uppercase">Informations</h2>
                            <div class="container" id="conteneur2Elements">
                                <div class="row">
                                    <div id="informationsGauche" class="col-md-6">
                                        <p class="text-white-50 mb-5"></p>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeNom" class="form-control form-control-lg" name="nom" required/>
                                            <label class="form-label" for="typeNom">Nom</label>
                                            <div class="invalid-feedback">Veuillez entrer un nom</div>
                                        </div>
                                        
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typePrenom" class="form-control form-control-lg" name="prenom" required />
                                            <label class="form-label" for="typePrenom">Prénom</label>
                                            <div class="invalid-feedback">Veuillez entrer un prénom</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="number" min="13" id="typeAge" class="form-control form-control-lg" name="age" required />
                                            <label class="form-label" for="typeAge">Age</label>
                                            <div class="invalid-feedback">Veuillez entrer votre age</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="url" id="typeLienCv" class="form-control form-control-lg" name="lienCv" required />
                                            <label class="form-label" for="typeLienCv">Lien CV</label>
                                            <div class="invalid-feedback">Veuillez entrer un lien vers votre CV</div>
                                        </div>
        
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeResidence" class="form-control form-control-lg" name="adresse"/>
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
                                        <div class="form-outline mb-4">                    
                                            <input type="text" id="typeReseau" class="form-control form-control-lg require" />
                                            <label class="form-label" for="typeReseau">Réseau</label>
                                            <div class="invalid-feedback">Veuillez entrer un réseau</div>
                                        </div>                                 
                                        
                                        <div class="form-outline mb-4">
                                            <input type="url" id="typeLien" class="form-control form-control-lg require"></textarea>
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

                <div class="card tab" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">

                            <h2 class="fw-bold mb-2 text-uppercase">Educations</h2>
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
                <div class="card tab " style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">

                            <h2 class="fw-bold mb-2 text-uppercase">Parcours professionnel</h2>
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
                <div class="card tab " style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center hiddenCards">
                
                        <div class="mb-md-5 mt-md-4 pb-5 ">                            
                            <h2 class="fw-bold mb-2 text-uppercase">Ajouter des projets</h2>

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
                <div class="card tab " style="border-radius: 1rem;">
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

                                    <select class="browser-default custom-select form-outline mb-4" id="lienProjet"></select>
                                </div>                                                 
                            </div>                       
                            <a class="ajouter" type="button">Ajouter</a>

                            <div class="form-outline mb-4 tableauElmt col-md-12"></div>

                            <button class="btn btn-secondary btn-lg px-5 mt-5 precedent" type="button">Précédent</button>
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
    <!-- our scirpt -->
    <script type="text/javascript" src="../js/formulaire.js"></script>
</body>

</html>