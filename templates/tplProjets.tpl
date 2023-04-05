
{% block projet %}

    {% for projet in projets %}

        <div class="row deletetable projet">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    {% if projet.getImage() is empty %}
                    {% else %}
                        <img src="../php/img_user/{{ projet.getImage() }}" alt="image projet" width="100%" >
                    {% endif %}
                </div>
                <div style="padding:30px;" class="col-md-8 justify-content-center">

                    <p style="position: relative;" class="editableText">
                        <strong class="editableText" style="font-size: 24px;"> {{ projet.getNom() }}</strong><br>
                        <strong class="editableText" > Taille de l'équipe &nbsp {{ projet.getTailleEquipe() }} personnes</strong><br>
                        <button><img src="../img/trash.png" alt=""></button> <br>
                        {{projet.getDescription()}}<br>
                        <a href="{{ projet.getLien() }}"<strong class="editableText" > En savoir plus </strong></a><br>
                    </p>
                </div>
            </div>
        

    {% endfor %}

    <div class="container d-flex justify-content-center align-items-center">
            <button id="btnAjouterProjet" class=" btn btn-floating btn-primary btn-lg"><i
                    class="fas fa-plus"></i></button>
    </div>

{% endblock %}