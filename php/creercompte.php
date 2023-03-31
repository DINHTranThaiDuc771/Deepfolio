<!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <link rel="stylesheet" href="css/creercompte.css" />
  </head>

<body>

  <?php
    $servername = "localhost";
    $username = "lp212835";
    $password = "1234";

    $conn = new mysqli($servername, $username, $password);

    if($conn->connect_error){
      die('Erreur : ' .$conn->connect_error);
    }
    echo 'Connexion réussie';
  ?>

  <!-- Start your project here-->
  <section class="vh-100 ">
    <div class="container-fluid py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">


          <div class="card tab" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Créer un compte</h2>
                <p class="text-white-50 mb-5"></p>

                <div class="form-outline mb-4">
                  <input type="text" id="typeNomUtilisateur" class="form-control form-control-lg" required/>
                  <label class="form-label" for="typeNomUtilisateur">Nom d'utilisateur</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" required />
                  <label class="form-label" for="typePasswordX">Mot de passe</label>
                </div>

                <button class="btn btn-primary btn-lg px-5 ml-2" type="submit" onclick="nextPrev(1)">Suivant</button>
              </div>
            </div>
          </div>

          <div class="card tab" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <!--
                prenom
                nom
                age
                ville
                iniversite
                mail
                -->
              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Vos Informations</h2>
                <p class="text-white-50 mb-5"></p>

                <div class="form-outline mb-4">
                  <input type="email" id="typeEmail" class="form-control"  required/>
                  <label class="form-label" for="typeEmail">Prenom</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="typeNom" class="form-control form-control-lg"  />
                  <label class="form-label" for="typeNom">Nom</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="number" id="typeAge" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeAge">Age</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="text" id="typeVille" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeVille">Ville</label>
                </div>
                
                <div class="form-outline mb-4">
                  <input type="email" id="typeMail" class="form-control form-control-lg" required />
                  <label class="form-label" for="typeMail">Mail</label>
                </div>
                <button class="btn btn-secondary btn-lg px-5 mt-5" type="submit" >Précédent</button>
                <button class="btn btn-primary btn-lg px-5 ml-2" type="submit">Suivant</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdbjs/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>