var isEditing = false;

var xEditBar;
var yEditBar;
var editbar;

var lstEditableText,lstDeletable,lstButtonSupprimer;
var lstEditableTextChanged;

var btnBold,btnUnderline,btnItalic;
var selectFont,selectSize,selectColor;

var btnNavbar;

var idPortfolio;
var auteur;


document.addEventListener("mousemove", function(event) {
    xEditBar = event.clientX;
    yEditBar = event.clientY;
});

window.onload = () => {
    lstEditableTextChanged = new Set();

    auteur = document.getElementById("auteur").value;
    idPortfolio = document.getElementById("idPortfolio").value;


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

    selectSize  .addEventListener("change",()=>{
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
    var divCv = document.getElementById("contentAll");
    var divFooter = document.getElementById("contentFooter");
    var oldPage = document.body.innerHTML;

    document.body.innerHTML = 
        "<html><head><title></title></head><body>" +
        divCv.innerHTML + divFooter.innerHTML + "</body>";

    window.print();
    document.body.innerHTML = oldPage;
}

function afficherEditorBar(event){
    event.target.setAttribute("anciennevaleur",event.target.textContent);
    console.log(event.target.textContent);
    if (event.target.closest('.deletetable') != null) 
        lstEditableTextChanged.add(event.target.closest('.deletetable'));
    else
        lstEditableTextChanged.add(event.target);
    
    editbar.style.display="flex";
    editbar.style.left = `${xEditBar}px`;
    editbar.style.top = `${yEditBar-50}px`;
}

function ajouterProjet()
{
    var html = `
        <div class="row deletetable projet nouveau">
        <div class="mb-5 col-md-4 d-flex justify-content-center">
            <img class="image" src="../img/favicon_io/android-chrome-192x192.png" alt="">
        </div>
        <div style="padding:30px;" class="col-md-8 d-flex justify-content-center">

            <p style="position: relative;"class="editableText desc">
                <strong class="editableText nom" style="font-size: 24px;">Nom Projet</strong><br>
                <strong class="editableText taille">5 personnes</strong>
                <button><img src="../img/trash.png" alt=""></button> <br>
                <h class="description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in
                culpa qui officia deserunt mollit anim id est laborum.
                </h>
                <strong class="editableText lien" > Lien </strong><br>
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
            <section class="content deletetable competence nouveau">
            <h1 class="editableText nom">Nom</h1>
            <article class="editableText">
                <div class="left">
                    <ul>
                        <li class="text-break description" >Description</li>
                        <li class="lien">Lien</li>
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
    /*Close nav when link clicked*/
    if (window.matchMedia("(max-width: 767px)").matches)
    {   
        btnNavbar.click();
    }

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

function updatePage(form_data) {

    $.ajax({
        type:"POST",
        dataType: 'script',
        contentType: false,
        processData: false,
        url:"../php/function.php",
        data: form_data,
        complete: function(data) {
            console.log(data.responseText);
        }
    });
}



function saveEdition (){
    toggleEdit();
  
   for ( var edit of lstEditableTextChanged ) {
        var classList = edit.classList;

        var type = getType(classList);

        var form_data = new FormData();
        form_data.append("type", type);
        form_data.append("action", "updatePage");

        form_data.append("idPortfolio", idPortfolio );
        form_data.append("auteur", auteur );

        form_data.append("text", edit.textContent);

        if ( classList.contains("nom-portfolio"))
        {
            form_data.append("nomAttr", "nomPortfolio");
        } 

        if ( classList.contains("description-site") )
        {
            form_data.append("nomAttr", "descriptionSite");

        } 

        if ( classList.contains("lien-cv"))
        {
            form_data.append("nomAttr", "lienCv");

        } 

        if ( classList.contains("ville"))
        {
            form_data.append("nomAttr", "adresse");

        } 

        if ( classList.contains("mail"))
        {
            form_data.append("nomAttr", "mail");

        } 

        if ( classList.contains("description"))
        {
            form_data.append("nomAttr", "presentation");
            form_data.append("text", edit.textContent.replaceAll("\"", ""));
        } 

        if ( classList.contains("description-reseau"))
        {
            form_data.append("nomAttr", "descriptionReseau");

        } 

        if ( classList.contains("competence"))
        {
            form_data.append("nomAttr", "competence");


            form_data.append("nouveau", edit.classList.contains("nouveau"));
            if ( edit.classList.contains("nouveau") ) edit.classList.remove("nouveau");

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));


            var nom = edit.querySelector(".nom").textContent;
            var description = edit.querySelector(".description").textContent;
            var lien = edit.querySelector(".lien").textContent;

            var text = nom + ";" + description + ";" + lien + ";";
            form_data.append("text", text);
        } 

        if ( classList.contains("projet"))
        {
            form_data.append("nomAttr", "projet");

            form_data.append("nouveau", edit.classList.contains("nouveau"));
            if ( edit.classList.contains("nouveau") ) edit.classList.remove("nouveau");

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));

            var nom = edit.querySelector(".nom").textContent;
            var taille = edit.querySelector(".taille").textContent;
            var description = edit.querySelector(".description").textContent;
            var lien = edit.querySelector(".lien").textContent;
            var image = edit.querySelector(".image");
            //revoir l'ilage

            var text = nom + ";" + description + ";" + taille + ";" + lien + ";" + image + ";";
            form_data.append("text", text);
        } 

        if ( classList.contains("age"))
        {
            form_data.append("nomAttr", "age");

        } 

        if ( classList.contains("nom-prenom"))
        {
            form_data.append("nomAttr", "nom-prenom");

        } 

        if ( classList.contains("diplome"))
        {
            form_data.append("nomAttr", "diplome");

        } 

        updatePage(form_data);
    }

    //location.reload();
    lstEditableTextChanged = new Set();
}

function getType( classList ) {

    var type;

    if ( classList.contains("nom-portfolio") || classList.contains("description-site") || classList.contains("mail") || classList.contains("description-reseau") ) {
        type = "infos";
    }

    if ( classList.contains("lien-cv") || classList.contains("ville") || classList.contains("description") || classList.contains("projet") || classList.contains("age") || classList.contains("nom-prenom") ) {
        type = "cv";
    }

    if ( classList.contains("projet") ) {
        type = "projets";
    }

    if ( classList.contains("competence") ) {
        type = "competences";
    }


    if ( classList.contains("diplome") ) {
        type = "parcours";
    }

    return type;
}