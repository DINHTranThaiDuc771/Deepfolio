{% for projet in projets %}

    <div class="row">
            <div class="mb-5 col-md-4 d-flex justify-content-center">
                {% if projet.getLien() is empty %}
                {% else %}
                    <img src="{{ projet.getLien() }}" alt="image projet">
                {% endif %}
            </div>
            <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">

                <p class="editableText">
                    <strong class="editableText" style="font-size: 24px;">projet.getNomProjet()</strong><br>
                    <strong class="editableText" >projet.gteTailleEquipe()</strong><br>

                    projet.getDescription();
                </p>
            </div>
        </div>
    

{% endfor %}