{% include "entete.tpl" %}

<div id="pageAccueil" class=" container-fluid">
{{ block("accueil", "tplAccueil.tpl") }}
</div>

<div id="pageCompetences"class="container-fluid tab print">
{{ block("competence", "tplCompetences.tpl") }}
</div>

<div id="pageProjets" class="container-fluid tab print">
{{ block("projet", "tplProjets.tpl") }}
</div>

<div id="pageCV"class="tab container justify-content-center">
{{ block("cv", "tplCV.tpl") }}
</div>

{% include "pied.tpl" %}