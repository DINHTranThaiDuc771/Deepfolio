    <!------------------->
    <!--    Contact------>
    <!------------------>
    <div id="pageContact"class="tab">
        <section class="vh-100 ">
            <div class="container-fluid py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <form id="formCreerCompte" action="./function.php" method="POST" class="needs-validation">

                            <div class="card " style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-4 text-uppercase">Contact</h2>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="typePrenom"
                                                class="form-control form-control-lg "
                                                name="prenom" onkeypress="return noenter()" required/>
                                            <label class="form-label" for="typeNomUtilisateur">Prénom</label>
                                            <div class="invalid-feedback">Veuillez entrer un Nom d'utilisateur</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeNom" class="form-control form-control-lg "
                                                name="nom" onkeypress="return noenter()" required/>
                                            <label class="form-label" for="typeNom">Nom</label>
                                            <div class="invalid-feedback">Veuillez entrer un Mot de passe</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="typeMail" class="form-control form-control-lg "
                                                name="mail" onkeypress="return noenter()" required/>
                                            <label class="form-label" for="typeMail">Mail</label>
                                            <div class="invalid-feedback">Veuillez entrer votre addresse mail</div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="typeObjet" class="form-control form-control-lg "
                                                name="objet" onkeypress="return noenter()" required/>
                                            <label class="form-label" for="typeObjet">Objet</label>
                                            <div class="invalid-feedback">Veuillez entrer votre Objet de message</div>
                                        </div>

                                        <div class="form-outline shadow-textarea mb-4">
                                            <textarea class="form-control z-depth-1 " id="exampleFormControlTextarea6"
                                                rows="3" name="message" placeholder="Message" required></textarea>
                                        </div>
                                        <input type="hidden" name='cle' value={{cle}}>

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
    <!---------------------->
    <div id="editbar">
        <button id="btnBold">B</button>
        <button id="btnUnderline">U</button>
        <button id="btnItalic">I</button>
        <select name="" id="selectSize">
            <option value="1"> Petit</option>
            <option value="2">Medium</option>
            <option value="3"> Large</option>
            <option value="4"> 4</option>
            <option value="5">5</option>
            <option value="6"> 6</option>
            <option value="7"> 7</option>

        </select>
        <select name="" id="selectFont">
            <option value="Arial">Arial</option>
            <option value="Times New Roman">Times New Roman</option>
            <option value="Verdana">Verdana</option>
        </select>
        <input  style="height: 40px;" type="color" id="selectColor">

    </div>

    <!--    Editbar------>
    <!------------------>
    <footer class="text-center text-lg-start bg-white text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span class="editableText">Connectez-vous avec nous sur les réseaux sociaux</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                {% for reseau in reseaux %}
                    <a href="{{ reseau.lien }}" class="me-4 link-secondary"> {{reseau.nom}}
                        <i class="fab fa-{{reseau.nomClasse}}"></i>
                    </a>
                {% endfor %}
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary" class="editableText"></i>{{nomPortfolio}}
                        </h6>
                        <p class="editableText">
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-address-card"></i> Mon CV
                        </h6>
                        <p class="editableText">
                            <a href="#">linkCV.com</a>
                        </p>
                    </div>

    


                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p class="editableText"><i class="fas fa-home me-3 text-secondary"></i> {{ ville }}</p>
                        <p class="editableText">
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            {{ mail }}
                        </p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Deepfolio</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!------------------->
    <!--    Footer------->
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