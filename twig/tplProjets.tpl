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
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in
                culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    

{% endfor %}