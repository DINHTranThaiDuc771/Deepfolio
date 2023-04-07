
{% block cv %}
    <div id="contentAll">
        <div id="contentNomPrenom" class="row mb-2">
            <h1 class="editableText nom-prenom"> {{ nom }} &nbsp {{ prenom }}</h1>
            <h1 class="editableText age">( {{ age }})</h1>
        </div>

        <hr>

        <div id="contentProfil" class="row">
            <h2>Profil</h2>
            <p style="font-style: normal">
                <strong>Ville : &nbsp<strong class="editableText ville" > {{ ville }}</strong> <br>
                {{ description }}
            </p >
        </div>

        <hr>

        <div id="contentCompetence" class="row  mb-2">
            <h2>Compétences</h2>
            <ul style="list-style: inside;">
                {% for competence in competences %}
                    <li style="font-style: normal;margin-bottom:10px"> {{ competence.getNom() }} </li>
                {% endfor %}
            </ul>
        </div>

        <hr>

        <div id="contentProjet" class="row  mb-2">
            <h2>Projet</h2>
            <ul style="list-style: none;">
                {% for projet in projets %}
                    <li class="projetli">
                        <a href="#{{ projet.getNom() }}"><h4 style="font-style: italic;"> {{ projet.getNom() }} </h4></a>
                        <p style="font-style: normal"> {{ projet.getDescription() }}</p>
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
                        <h4 style="font-style: italic;"> {{ poste.getPoste() }}-{{poste.getEntreprise() }}</h4>
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
                        <h4 style="font-style: italic;">{{ diplome.getNom() }}-{{ diplome.getEtablissement() }}</h4>
                        <p >{{ diplome.getAnneeObtention() }}</p>
                    </li>
                {% endfor %}
            </ul>
        </div>

    </div>

    <button id="btnTelecharger" class="btn btn-primary btn-lg px-5 ml-2  mb-4">Télécharger</button>

{% endblock %}