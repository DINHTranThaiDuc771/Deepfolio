

window.onload = () => {
    var pageAccueil             = document.getElementById("pageAccueil");
    var pageCompetences         = document.getElementById("pageCompetences");
    var pageProjets             = document.getElementById("pageProjets");
    var pageCV                  = document.getElementById("pageCV");
    var pageContact             = document.getElementById("pageContact");

    var linkAccueil             = document.getElementById("linkAccueil");
    var linkCompetences         = document.getElementById("linkCompetences");
    var linkProjets             = document.getElementById("linkProjets");
    var linkCV                  = document.getElementById("linkCV");
    var linkContact             = document.getElementById("linkContact");

    linkAccueil     .addEventListener("click",function(){changerTab("linkAccueil");},false);
    linkCompetences .addEventListener("click",function(){changerTab("linkCompetences");},false);
    linkProjets     .addEventListener("click",function(){changerTab("linkProjets");},false);
    linkCV          .addEventListener("click",function(){changerTab("linkCV");},false);
    linkContact     .addEventListener("click",function(){changerTab("linkContact");},false);
    


    function changerTab(tab){
        console.log(tab)
        if (tab==="linkAccueil") {
            pageAccueil     .classList.remove("tab");
            pageCompetences .classList.add("tab");
            pageProjets     .classList.add("tab");
            pageCV          .classList.add("tab");
            pageContact     .classList.add("tab");

            return;
        }
        if (tab==="linkCompetences") {
            pageAccueil     .classList.add("tab");
            pageCompetences .classList.remove("tab");
            pageProjets     .classList.add("tab");
            pageCV          .classList.add("tab");
            pageContact     .classList.add("tab");

            return;

        }
        if (tab==="linkProjets") {
            pageAccueil     .classList.add("tab");
            pageCompetences .classList.add("tab");
            pageProjets     .classList.remove("tab");
            pageCV          .classList.add("tab");
            pageContact     .classList.add("tab");

            return;

        }
        if (tab==="linkCV") {
            pageAccueil     .classList.add("tab");
            pageCompetences .classList.add("tab");
            pageProjets     .classList.add("tab");
            pageCV          .classList.remove("tab");
            pageContact     .classList.add("tab");

            return;

        }
        if (tab==="linkContact") {
            pageAccueil     .classList.add("tab");
            pageCompetences .classList.add("tab");
            pageProjets     .classList.add("tab");
            pageCV          .classList.add("tab");
            pageContact     .classList.remove("tab");

            return;
        }

    }
}