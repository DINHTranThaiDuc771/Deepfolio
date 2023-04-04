
{% block projet %}

    {% for projet in projets %}

        <div class="row">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    {% if projet.getImage() is empty %}
                    {% else %}
                        <img src="{{ projet.getImage() }}" alt="image projet">
                    {% endif %}
                </div>
                <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">

                    <p class="editableText">
                        <strong class="editableText" style="font-size: 24px;"> {{ projet.getNom() }}</strong><br>
                        <strong class="editableText" > {{ projet.getTailleEquipe() }}</strong><br>
                        {{projet.getDescription()}}
                        <a href="{{ projet.getLien() }}"<strong class="editableText" > En savoir plus </strong><br>
                    </p>
                </div>
            </div>
        

    {% endfor %}

{% endblock %}