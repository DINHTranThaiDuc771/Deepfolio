var isEditing = false;

window.onload = () => {
    /**Changer Tab */
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
    
    //Editer
    var lstEditableText = document.getElementsByClassName("editableText");
    var btnToggleEdit = document.getElementById("btnToggleEdit");
    btnToggleEdit       .addEventListener("click",()=>{toggleEdit(lstEditableText)},false);
    //Les btn pour ajouter
    var btnAjouterProjet = document.getElementById("btnAjouterProjet");
    var btnAjouterComp   = document.getElementById("btnAjouterComp");
    btnAjouterProjet.addEventListener("click",ajouterProjet,false);
    btnAjouterComp  .addEventListener("click",ajouterComp  ,false);

}
btnAjouterProjet.style.display = "none";
btnAjouterComp  .style.display = "none";
function ajouterProjet()
{
    var html = '<div class="row">' +
    '<div class="mb-5 col-md-4 d-flex justify-content-center">' +
    '<img src="../img/favicon_io/android-chrome-192x192.png" alt="">' +
    '</div>' +
    '<div style="padding:30px;" class="col-md-8 d-flex justify-content-center">' +
    '<p class="editableText">' +
    '<strong class="editableText" style="font-size: 24px;">Nom Projet</strong><br>' +
    '<strong class="editableText">5 personnes</strong><br>' +
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ' +
    'et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut ' +
    'aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse ' +
    'cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in ' +
    'culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur ' +
    'adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim ' +
    'veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in ' +
    'culpa qui officia deserunt mollit anim id est laborum.' +
    '</p>' +
    '</div>' +
    '</div>';
    btnAjouterProjet.parentNode.insertAdjacentHTML("beforebegin", html);
    lstEditableText = document.getElementsByClassName("editableText");
    for (var i=0; i< lstEditableText.length; i++)

    {   
        lstEditableText[i].setAttribute("contenteditable","true");
        lstEditableText[i].classList.add("isEditText");
    }
}
function ajouterComp () 
{
    const newHtml = `
            <section class="content ">
            <h1 class="editableText">Elaborer des conceptions simples</h1>
            <article class="editableText">
                <div class="left">
                    <ul>
                        <li>Je sais construire UML diagram (en respectant les normes grâce à uml-diagrams.org)</li>
                        <li>Je sais utiliser Github pour gerer les versions de mon projet</li>
                    </ul>
                </div>

            </article>
        </section>
    `;

    btnAjouterComp.parentNode.insertAdjacentHTML('beforebegin', newHtml);
    lstEditableText = document.getElementsByClassName("editableText");
    for (var i=0; i< lstEditableText.length; i++)

    {   
        lstEditableText[i].setAttribute("contenteditable","true");
        lstEditableText[i].classList.add("isEditText");
    }
}
function toggleEdit(lstEditableText) {
    isEditing = !isEditing;
    if (isEditing)
    {
        for (var i=0; i< lstEditableText.length; i++)

        {   
            lstEditableText[i].setAttribute("contenteditable","true");
            lstEditableText[i].classList.add("isEditText");
        }
        btnAjouterProjet.style.display = "inline-block";
        btnAjouterComp  .style.display = "inline-block";
        return;
    }
    if (!isEditing)
    {
        for (var i=0; i< lstEditableText.length; i++)
        {
            lstEditableText[i].setAttribute("contenteditable","false");
            lstEditableText[i].classList.remove("isEditText");

        }
        btnAjouterProjet.style.display = "none";
        btnAjouterComp  .style.display = "none";
        return;
    }
}

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

winndows.onload = () =>{
        
    // Example indexer JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');
        console.log(forms);

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
        form.addEventListener('submit', (event) => {
            
            if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
        });
    })();
}