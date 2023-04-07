
{% block accueil %}
    <div class="row">
        <div class="col-md-6 d-flex justify-content-center text-break">
            <p  class="editableText description" id="quote"> " {{ description }} "</p>
        </div>
        <div class="col-md-6 d-flex justify-content-center editableImage">
            <img id="hero-image" src="..\img\favicon_io\hero-image.jpg" alt="hero-image">
        </div>
    </div>
    <div class="pagebreak"> </div>
{% endblock %}