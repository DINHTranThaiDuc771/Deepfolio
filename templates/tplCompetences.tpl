
{% block competence %}

    {% for competence in competences %}

        <section class="content ">
            <h1 class="editableText"> {{competence.getNom() }} </h1>
            <article  class="editableText">
                <div class="left">
                    <ul>
                        <li>{{competence.getDescription() }}</li>
                        <li><a href="{{competence.getLien()}}">Ce qui prouve ma competence</a> </li>
                    </ul>
                </div>
            </article>
        </section>

    {% endfor %}

{% endblock %}