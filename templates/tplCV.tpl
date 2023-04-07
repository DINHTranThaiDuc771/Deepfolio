
{% block cv %}
    <div id="contentAll">
        <div id="contentNomPrenom" class="row mb-2">
            <h1 class="editableText nom-prenom"> {{ nom }} &nbsp {{ prenom }}</h1>
            <h1 class="editableText age">( {{ age }})</h1>
        </div>

        <hr>

        <div id="contentProfil" class="row">
            <h2>Profil</h2>
            <p>
                <strong>Ville : &nbsp<strong class="editableText ville" > {{ ville }}</strong> <br>
                {{ description }}
            </p >
        </div>

        <hr>

        <div id="contentCompetence" class="row  mb-2">
            <h2>Compétences</h2>
            <ul style="list-style: none;">
                {% for competence in competences %}
                    <li> {{ competence.getNom() }} </li>
                {% endfor %}
            </ul>
        </div>

        <hr>

        <div id="contentProjet" class="row  mb-2">
            <h2>Projet</h2>
            <ul style="list-style: none;">
                {% for projet in projets %}
                    <li class="projetli">
                        <a href="#{{ projet.getNom() }}"><h3> {{ projet.getNom() }} </h3></a>
                        <p > {{ projet.getDescription() }}</p>
                    </li>
                {% endfor %}
            </ul>
        </div>

        <hr>

        <div id="contentExperience" class="row  mb-2">
            <h2>Expérience</h2>
            <ul style="list-style: none;">
                {% for poste in postes %}
                    <li class="editableText poste">
                        <h3> {{ poste.getPoste() }}-{{poste.getEntreprise() }}</h3>
                        <strong>{{ poste.getDateDebut() }}/{{ poste.getDateFin() }}</strong><br>
                        <p> {{ poste.getDescription() }}</p>
                    </li>
                {% endfor %}
            </ul>
        </div>

        <hr>

        <div id="contentParcoursAcademique" class="row  mb-2">
            <h2>Parcours Académique</h2>
            <ul style="list-style: none;">
                {% for diplome in diplomes %}
                    <li class="editableText diplome">
                        <h3 >{{ diplome.getNom() }}-{{ diplome.getEtablissement() }}</h3>
                        <p >{{ diplome.getAnneeObtention() }}</p>
                    </li>
                {% endfor %}
            </ul>
        </div>

    </div>

    <button id="btnTelecharger" class="btn btn-primary btn-lg px-5 ml-2  mb-4">Télécharger</button>

{% endblock %}