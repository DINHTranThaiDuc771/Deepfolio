var isEditing = false;
var xEditBar;
var yEditBar;
var lstEditableText,lstDeletable,lstButtonSupprimer;
var editbar;
var btnBold,btnUnderline,btnItalic;
var selectFont,selectSize,selectColor;
var lstEditableTextChanged;
var btnNavbar;
lstEditableTextChanged = new Set();

document.addEventListener("mousemove", function(event) {
    xEditBar = event.clientX;
    yEditBar = event.clientY;
});

window.onload = () => {
    btnNavbar       = document.querySelector('.navbar-toggler');
    editbar         = document.getElementById("editbar");
    btnBold         = document.getElementById("btnBold");
    btnUnderline    = document.getElementById("btnUnderline");
    btnItalic       = document.getElementById("btnItalic");
    selectFont      = document.getElementById("selectFont");    
    selectSize      = document.getElementById("selectSize");
    selectColor     = document.getElementById("selectColor");

    btnBold     .addEventListener("click",()=>{styleBUI("bold")},false);
    btnUnderline.addEventListener("click",()=>{styleBUI("underline")},false);
    btnItalic   .addEventListener("click",()=>{styleBUI("italic")},false);

    selectFont  .addEventListener("change",()=>{
        styleFont(selectFont.value);
    },false);

    selectSize  ;addEventListener("change",()=>{
        styleSize(selectSize.value);
    },false);

    selectColor.addEventListener("input",()=>{
        styleColor(selectColor.value);
    },false);



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
    lstEditableText     = document.getElementsByClassName("editableText");
    lstDeletable        = document.getElementsByClassName("deletetable");
    lstButtonSupprimer  = document.querySelectorAll('.deletetable button');

    var btnToggleEdit   = document.getElementById("btnToggleEdit");
    btnToggleEdit       .addEventListener("click",()=>{toggleEdit()},false);
    //Les btn pour ajouter
    var btnAjouterProjet = document.getElementById("btnAjouterProjet");
    var btnAjouterComp   = document.getElementById("btnAjouterComp");

    btnAjouterProjet.style.display = "none";
    btnAjouterComp  .style.display = "none";

    btnAjouterProjet.addEventListener("click",ajouterProjet,false);
    btnAjouterComp  .addEventListener("click",ajouterComp  ,false);
    //
    var btnHome,btnSauver;

    btnHome = document.getElementById("btnHome");
    btnSauver = document.getElementById("btnSauver");
    btnSauver.addEventListener("click",saveEdition,false);

    btnSauver       .style.display = "none";

    // Telechargement du CV
    var btnTelecharger = document.getElementById("btnTelecharger");
    btnTelecharger.addEventListener("click",telechargerCV,false);
}

function telechargerCV()
{
    console.log("dl cv pdf");
}

function afficherEditorBar(event){
    lstEditableTextChanged.add(event.target);
    console.log (lstEditableTextChanged);
    editbar.style.display="flex";
    editbar.style.left = `${xEditBar}px`;
    editbar.style.top = `${yEditBar-50}px`;
}

function ajouterProjet()
{
    var html = `
        <div class="row deletetable projet">
        <div class="mb-5 col-md-4 d-flex justify-content-center">
            <img src="../img/favicon_io/android-chrome-192x192.png" alt="">
        </div>
        <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">

            <p style="position: relative;"class="editableText">
                <strong class="editableText" style="font-size: 24px;">Nom Projet</strong><br>
                <strong class="editableText">5 personnes</strong>
                <button><img src="../img/trash.png" alt=""></button> <br>

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
    `       
    ;
    btnAjouterProjet.parentNode.insertAdjacentHTML("beforebegin", html);
    refreshListEditable();

}
function ajouterComp () 
{
    const newHtml = `
            <section class="content deletetable competence">
            <h1 class="editableText">Elaborer des conceptions simples</h1>
            <article class="editableText">
                <div class="left">
                    <ul>
                        <li>Je sais construire UML diagram (en respectant les normes grâce à uml-diagrams.org)</li>
                        <li>Je sais utiliser Github pour gerer les versions de mon projet</li>
                    </ul>
                </div>
            </article>
            <button ><img src="../img/trash.png" alt=""></button>

        </section>
    `;

    btnAjouterComp.parentNode.insertAdjacentHTML('beforebegin', newHtml);
    refreshListEditable();
}
function toggleEdit() {
    isEditing = !isEditing;
    if (isEditing)
    {
        for (var i=0; i< lstEditableText.length; i++)

        {   
            lstEditableText[i].setAttribute("contenteditable","true");
            lstEditableText[i].setAttribute("tabindex","0");
            lstEditableText[i].addEventListener("focus",(event)=>{afficherEditorBar(event)} ,false);


            lstEditableText[i].classList.add("isEditText");
        }
        for (var i=0; i< lstButtonSupprimer.length; i++)
        {   
            lstButtonSupprimer[i].addEventListener("click",(event)=>{supprimerDeleteable(event)},false);
            lstButtonSupprimer[i].style.display = "block";

        }
        btnAjouterProjet.style.display = "inline-block";
        btnAjouterComp  .style.display = "inline-block";
        btnSauver       .style.display = "inline-block";
        return;
    }

    if (!isEditing)
    {
        for (var i=0; i< lstEditableText.length; i++)
        {
            lstEditableText[i].setAttribute("contenteditable","false");
            lstEditableText[i].removeAttribute("tabindex");
            lstEditableText[i].classList.remove("isEditText");

        }
        for (var i=0; i< lstButtonSupprimer.length; i++)
        {   
            lstButtonSupprimer[i].style.display = "none";

        }
        btnAjouterProjet.style.display = "none";
        btnAjouterComp  .style.display = "none";
        btnSauver       .style.display = "none";
        editbar         .style.display = "none";
        return;
    }
}

function changerTab(tab){
        /*Close nav when link clicked*/
        if (window.matchMedia("(max-width: 767px)").matches)
        {   
            btnNavbar.click();
        }
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


function refreshListEditable() {
    lstEditableText     = document.getElementsByClassName("editableText");
    lstDeletable        = document.getElementsByClassName("deletetable");
    lstButtonSupprimer  = document.querySelectorAll('.deletetable button');
    //list Editable Text
    for (var i=0; i< lstEditableText.length; i++)

    {   
        lstEditableText[i].setAttribute("contenteditable","true");
        lstEditableText[i].setAttribute("tabindex","0");
        lstEditableText[i].classList.add("isEditText");
        lstEditableText[i].addEventListener("focus",(event)=>{afficherEditorBar(event)} ,false);

    }
    // list button supprimer
    for (var i=0; i< lstButtonSupprimer.length; i++)
    {   
        lstButtonSupprimer[i].addEventListener("click",(event)=>{supprimerDeleteable(event)},false);
        lstButtonSupprimer[i].style.display = "block";
    }
}

function supprimerDeleteable(event){
    console.log("supprimer");
    const deletableDiv = event.target.closest('.deletetable');
    deletableDiv.style.opacity = '0';
    setTimeout(() => {
        deletableDiv.remove();
    }, 500);
}

function styleBUI (style) {
    const selection = window.getSelection().toString();
    if (selection.length > 0) {
        document.execCommand(style);
    }
}

function styleFont(font){
    const selection = window.getSelection().toString();
    if (selection.length > 0) {
        document.execCommand("fontname",false,font);
    }
}

function styleSize(size){
    const selection = window.getSelection().toString();
    if (selection.length > 0) {
        document.execCommand("fontsize",false,size);
    }
}

function styleColor(color){
    const selection = window.getSelection().toString();
    if (selection.length > 0) {
        document.execCommand("foreColor", false, color);
    }
}


function saveEdition (){
    toggleEdit();
    console.log(lstEditableText);
    
}