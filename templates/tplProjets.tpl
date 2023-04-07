
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
                    <button class="btn btn-danger"><img src="../img/trash.png" alt=""></button>
                    <p style="position: relative;" class="editableText">
                        <span style="display:block" class="editableText nom" style="font-size: 24px;">{{ projet.getNom() }}</span>
                        <strong>Taille de l'équipe &nbsp</strong>
                        <span style="display:inline-block">
                            <strong style="display:block" class="editableText taille" >{{ projet.getTailleEquipe() }}</strong>
                        </span>
                        <strong> personnes</strong><br>
                        <span style="display:block" class="description editableText">{{projet.getDescription()}}</span><br>
                        <span style="display:block">
                            <a href="{{ projet.getLien() }}" target="_blank" ><strong style="display:block" class="editableText lien" >Lien</strong></a><br>
                        </span>
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

