
{% block accueil %}
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center text-break">
            {% if debug == "true" %}
            <p id="smallp" class="smallp editableText description"> " {{ description }} "</p>
            {% else %}
            <p id="quote" class="smallp editableText description"> " {{ description }} "</p>
            {% endif %}
        </div>

        <div class="col-md-6 d-flex justify-content-center" >
            {% if imageAccueil == "" %}
            <img id="editableImg" src="..\img\favicon_io\hero-image.jpg" alt="hero-image" >
            {% else %}
            <img class="image" id="editableImg" src="../php/img_user/{{ imageAccueil }}" alt="image accueil" width="100%" nom="{{ imageAccueil }}">
            {% endif %}
        </div>
    </div>
    <div class="pagebreak"> </div>
{% endblock %}