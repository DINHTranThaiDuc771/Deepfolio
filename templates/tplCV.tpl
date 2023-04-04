
{% block cv %}
    <div class="row mb-2">
        <h1 class="editableText"> {{ prenom }} {{ nom }}</h1>
        <h1 class="editableText">( {{ age }})</h1>
    </div>
    <hr>
    <div class="row">
        <h2>Profil</h2>
        <p class="editableText">
            <strong>Ville : {{ ville }}</strong> <br>
            {{ description }}
        </p class="editableText">
    </div>
    <hr>
    <div class="row  mb-2">
        <h2>Compétences</h2>
        <li style="list-style: none;">
            {% for competence in competences %}
                <ul class="editableText">{{ nomCompetence }} </ul>
            {% endfor %}
        </li>
    </div>
    <hr>
    <div class="row  mb-2">
        <h2>Projet</h2>
        <li style="list-style: none;">
            {% for projet in projets %}
                <ul>
                    <a href="#"><h3 class="editableText"> {{ projet.getNom() }}</h3></a>
                    <p class="editableText"> {{ projet.getDescription() }}</p>
                </ul>
            {% endfor %}
        </li>
    </div>
    <hr>
    <div class="row  mb-2">
        <h2>Expérience</h2>
        <li style="list-style: none;">
            {% for poste in postes %}
                <ul>
                    <h3 class="editableText"> {{ poste.getNom() }} dans {{poste.getEntreprise() }}</h3>
                    <p class="editableText"> {{ poste.getDescription() }}</p>
                </ul>
            {% endfor %}
        </li>
    </div>
    <hr>
    <div class="row  mb-2">
        <h2>Parcours Académique</h2>
        <li style="list-style: none;">
            {% for diplome in diplomes %}
                <ul>
                    <h3 class="editableText">{{ diplome.getEtablissement() }}</h3>
                    <p class="editableText">{{ diplome.getDescription() }}</p>
                </ul>
            {% endfor %}
        </li>
    </div>
    <button class="btn btn-primary btn-lg px-5 ml-2  mb-4">Télécharger</button>

{% endblock %}