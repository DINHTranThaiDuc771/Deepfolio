
{% block competence %}

    {% for competence in competences %}

        <section class="content deletetable competence">
            <h1 class="editableText nom">{{competence.getNom() }}</h1>
            <article  class="editableText">
                <div class="left">
                    <ul>
                        <li class="text-break description" >{{competence.getDescription() }}</li>
                        {% if competence.getLien() != "" %}
                            <li><a class="lien" href="{{competence.getLien()}}">Ce qui prouve ma competence :&nbsp{{ competence.getLien() }} </a> </li>
                        {% endif %} 
                    </ul>
                </div>
            </article>
            <button class="btn btn-danger"><img src="../img/trash.png" alt=""></button>
        </section>

    {% endfor %}

    <div class="container d-flex justify-content-center align-items-center">
            <button id="btnAjouterComp" class=" btn btn-floating btn-primary btn-lg"><i
                    class="fas fa-plus"></i></button>
    </div>

{% endblock %}