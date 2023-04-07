
{% block projet %}

    {% for projet in projets %}

        <div class="row deletetable projet" id="{{ projet.getNom() }}">
                <div class="mb-5 col-md-4 d-flex justify-content-center">
                    {% if projet.getImage() is empty %}
                    {% else %}
                        <img class="image" src="../php/img_user/{{ projet.getImage() }}" alt="image projet" width="100%" nom="{{ projet.getImage() }}">
                    {% endif %}
                </div>
                <div style="padding:30px;" class="col-md-8 justify-content-center">

                    <p style="position: relative;" class="editableText">
                        <strong class="editableText nom" style="font-size: 24px;">{{ projet.getNom() }}</strong><br>
                        <strong>Taille de l'équipe &nbsp</strong><strong class="editableText taille" >{{ projet.getTailleEquipe() }}</strong><strong> personnes</strong><br>
                        <button class="btn btn-danger"><img src="../img/trash.png" alt=""></button>
                        <span class="description editableText">{{projet.getDescription()}}</span><br>
                        <a href="{{ projet.getLien() }}" target="_blank" ><strong class="editableText lien" >Lien</strong></a><br>
                    </p>
                </div>
            </div>
        

    {% endfor %}

    <div class="container d-flex justify-content-center align-items-center">
            <button id="btnAjouterProjet" class=" btn btn-floating btn-primary btn-lg"><i
                    class="fas fa-plus"></i></button>
    </div>

    <div class="pagebreak"> </div>

{% endblock %}+