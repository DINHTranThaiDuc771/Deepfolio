
{% block projet %}

    {% for projet in projets %}

        <div class="row">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    {% if projet.getImage() is empty %}
                        pas bon {{projet.getImage()}}
                    {% else %}
                        <img src="../php/img_user/{{ projet.getImage() }}" alt="image projet" width="100%" >
                    {% endif %}
                </div>
                <div style="padding:30px;" class="col-md-8 justify-content-center">

                    <p class="editableText">
                        <strong class="editableText" style="font-size: 24px;"> {{ projet.getNom() }}</strong><br>
                        <strong class="editableText" > Taille de l'équipe &nbsp {{ projet.getTailleEquipe() }}</strong><br>
                        {{projet.getDescription()}}<br>
                        <a href="{{ projet.getLien() }}"<strong class="editableText" > En savoir plus </strong></a><br>
                    </p>
                </div>
            </div>
        

    {% endfor %}

{% endblock %}