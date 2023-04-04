    <!------------------->
    <!--    Contact------>
    <!------------------>
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

    <!------------------->
    <!--    Editbar------>
    <!--------
    <div id="editbar">
        <div class="form-outline">
            <input type="text" id="form16" class="form-control" data-mdb-showcounter="true" maxlength="20" />
            <label class="form-label" for="form16">Example label</label>
            <div class="form-helper"></div>
          </div>

    </div>
           -------------->
    <!--    Editbar------>
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