var isEditing = false;

var xEditBar;
var yEditBar;
var editbar;

var lstEditableText,lstDeletable,lstButtonSupprimer;
var lstAdded, lstDeleted;
var lstEditableTextChanged;

var btnBold,btnUnderline,btnItalic;
var selectFont,selectSize,selectColor;

var btnNavbar;

var idPortfolio;
var auteur;

var cbAccess;
var cbAccessible;
var btnChangerBackgroundColor;

var isCtrl = false;
var quote;
document.onkeyup=function(e){
    if(e.keyCode == 17) isCtrl=false;
}

document.onkeydown=function(e){
    if(e.keyCode == 17) isCtrl=true;
    if(e.keyCode == 83 && isCtrl == true && isEditing == true) {
        saveEdition();
        console.log('control + s')
        return false;
    }
}


document.addEventListener("mousemove", function(event) {
    xEditBar = event.clientX;
    yEditBar = event.clientY;
});

window.onload = () => {
    quote           = document.getElementById("quote");
    while (quote.scrollHeight > quote.clientHeight) {
        quote.style.fontSize = parseInt(window.getComputedStyle(quote).fontSize) - 1 + 'px';
    }
    quote.addEventListener("input",()=>{
        while (quote.scrollHeight > quote.clientHeight) {
            quote.style.fontSize = parseInt(window.getComputedStyle(quote).fontSize) - 1 + 'px';
        }  
    });
    var competences = document.querySelectorAll("#pageCompetences .lien");
    for ( var lien of competences) {
        var href = lien.getAttribute("href").toString();
        if ( href.includes("#")) {
            lien.addEventListener("click", (event) => {
                changerTab("linkProjets");
            });
        }
    }

    var projets = document.querySelectorAll("#contentProjet .projetli");
    for ( var lien of projets) {
        lien.addEventListener("click", (event) => {
            changerTab("linkProjets");
        });
    }
    

    //Btn color background
    btnChangerBackgroundColor = document.createElement("input");
    btnChangerBackgroundColor.setAttribute("type","color");
    btnChangerBackgroundColor.style.position = "fixed";
    btnChangerBackgroundColor.style.bottom   = "50px";
    btnChangerBackgroundColor.style.right   = "50px";
    btnChangerBackgroundColor.style.display    = "none";
    btnChangerBackgroundColor.style.width    = "50px";
    btnChangerBackgroundColor.style.height    = "50px";
    btnChangerBackgroundColor.addEventListener("input",(event)=> {changementBackground(event.target.value);});
    document.body.appendChild(btnChangerBackgroundColor);


    lstEditableTextChanged = new Set();
    lstAdded              = new Set();
    lstDeleted            = new Set();

    auteur = document.getElementById("auteur").value;
    idPortfolio = document.getElementById("idPortfolio").value;


    cbAccess        = document.getElementById("cbAccess");
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
    btnHome.addEventListener("click",()=>{
        if(isEditing == true)
        {
            if(confirm("Voulez-vous sauvegarder les modifications ?"))
            {
                saveEdition();
            }
        }
    });


    btnSauver = document.getElementById("btnSauver");
    btnSauver.addEventListener("click",saveEdition,false);

    btnSauver.style.display = "none";
    cbAccess.classList.add("tab");


    // Telechargement du CV
    var btnTelecharger = document.getElementById("btnTelecharger");
    btnTelecharger.addEventListener("click",telechargerCV,false);
}

function telechargerCV()
{
    var divAll = document.getElementById("contentAll");
    var oldPage = document.body.innerHTML;

    document.body.innerHTML = 
        "<html><head><title></title></head><body>" +
        divAll.innerHTML + "</body>";

    window.print();
    document.body.innerHTML = oldPage;

    location.reload();
}

function afficherEditorBar(event){
    event.target.setAttribute("anciennevaleur",event.target.textContent);
    
    if (event.target.closest('.deletetable') != null) {
        lstEditableTextChanged.add(event.target.closest('.deletetable'));
        var edit = event.target.closest('.deletetable');
        var nom = edit.querySelector('.nom');

        if ( !nom.hasAttribute("anciennevaleur"))
            nom.setAttribute("anciennevaleur", nom.textContent);
    }
    else {
        lstEditableTextChanged.add(event.target);
    }
   
    /*
    editbar.style.display="flex";
    editbar.style.left = `${xEditBar}px`;
    editbar.style.top = `${yEditBar-50}px`;
    */
}

function ajouterProjet()
{
    var html = `
        <div class="row deletetable projet nouveau">
        <div class="mb-5 col-md-4 d-flex justify-content-center">
            <input type="file" accept=".jpg, .jpeg, .png, .svg" class="form-control form-control-lg image"  />
        </div>
        <div style="padding:30px;" class="col-md-8 justify-content-center">
            <button class="btn btn-danger"><img src="../img/trash.png" alt=""></button>
            <p style="position: relative;" class="editableText notEditable">
                <span class="editableText nom" style="display:block;font-weight:bold" style="font-size: 24px;">Nom projet</span><br>
                <strong>Taille de l'équipe &nbsp</strong><span style="display:inline-block"><strong style="display:block" class="editableText taille" >?</strong></span><strong> personnes</strong><br>
                <span style="display:block" class="description editableText">Description</span><br>
                <span style="display:block">
                    <a href="{{ projet.getLien() }}" target="_blank" ><strong  style="display:block" class="editableText lien" >Lien</strong></a><br>
                </span>
            </p>
        </div>
    </div>  
    `       
    ;
    btnAjouterProjet.parentNode.insertAdjacentHTML("beforebegin", html);
    lstAdded.add(btnAjouterProjet.parentNode.previousElementSibling);
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
                        <li class="text-break description" >
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatunt in
                        culpa qui officia deserunt mollit anim id est laborum.
                        </li>
                        <li class="lien"> Lien : </li>
                    </ul>
                </div>
            </article>
            <button class="btn btn-danger"><img src="../img/trash.png" alt=""></button>

        </section>
    `;

    btnAjouterComp.parentNode.insertAdjacentHTML('beforebegin', newHtml);
    lstAdded.add(btnAjouterComp.parentNode.previousElementSibling);

    refreshListEditable();
}

function toggleEdit() {

    if(isEditing == true){
        location.reload();
    }

    cbAccessible = document.getElementById("cbAccessible");
    cbAccessible.addEventListener("click", changeAccessibility)

    getAccessibility();

    isEditing = !isEditing;
    /*Close nav when link clicked*/
    if (window.matchMedia("(max-width: 767px)").matches)
    {   
        btnNavbar.click();
    }

    if (isEditing)
    {

        var img = document.getElementById("editableImg");
        var parent = img.parentElement;

        parent.removeChild(img);

        img = document.createElement("input");

        img.setAttribute("type","file");
        img.setAttribute("accept", ".jpg, .jpeg, .png, .svg");

        img.classList.add("form-control");
        img.classList.add("form-control-lg");
        img.classList.add("imageAccueil");

        img.setAttribute("id", "editableImg");

        parent.appendChild(img);

        img.addEventListener("focus",(event)=>{afficherEditorBar(event)} ,false);
        for (var i=0; i< lstEditableText.length; i++)
        {   
            if (!lstEditableText[i].classList.contains("notEditable"))
                lstEditableText[i].setAttribute("contenteditable","true");
                
            lstEditableText[i].setAttribute("tabindex","0");
            lstEditableText[i].addEventListener("focus",(event)=>{afficherEditorBar(event)} ,false);
            lstEditableText[i].addEventListener("keydown",event=>preventKeydown(event),false);

            lstEditableText[i].classList.add("isEditText");

        }

        for (var i=0; i< lstButtonSupprimer.length; i++)
        {   
            lstButtonSupprimer[i].addEventListener("click",(event)=>{supprimerDeleteable(event)},false);
            lstButtonSupprimer[i].style.display = "block";

        }

        btnAjouterProjet                .style.display = "inline-block";
        btnAjouterComp                  .style.display = "inline-block";
        btnSauver                       .style.display = "inline-block";
        btnChangerBackgroundColor       .style.display = "inline-block";
        cbAccess        .classList.remove("tab");

        rgbValue                                       = window.getComputedStyle(document.body, null).backgroundColor;
        const hexValue = '#' + rgbValue.match(/\d+/g).map(x => parseInt(x).toString(16).padStart(2, '0')).join('');
        btnChangerBackgroundColor       .value         = hexValue;

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
        btnChangerBackgroundColor       .style.display = "none";

        cbAccess        .classList.add("tab");

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
        if (!lstEditableText[i].classList.contains("notEditable"))
            lstEditableText[i].setAttribute("contenteditable","true");
        lstEditableText[i].setAttribute("tabindex","0");
        lstEditableText[i].classList.add("isEditText");
        lstEditableText[i].addEventListener("focus",(event)=>{afficherEditorBar(event)} ,false);
        lstEditableText[i].addEventListener("keydown",event=>preventKeydown(event),false);
    }
    // list button supprimer
    for (var i=0; i< lstButtonSupprimer.length; i++)
    {   
        lstButtonSupprimer[i].addEventListener("click",(event)=>{supprimerDeleteable(event)},false);
        lstButtonSupprimer[i].style.display = "block";
    }
}

function supprimerDeleteable(event){
    var deletableDiv = event.target.closest('.deletetable');
    var nom = deletableDiv.querySelector('.nom');
    nom.setAttribute("anciennevaleur", nom.textContent);
    lstDeleted.add(deletableDiv);

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
        async: false,
        url:"../php/function.php",
        data: form_data,
        complete: function(data) {
            console.log(data.responseText);
        }
    });
}

function changementBackground(col) {
    document.body.style.background= col;
}


function saveEdition (){
    toggleEdit();

  
   for ( var edit of lstEditableTextChanged ) {
        var classList = edit.classList;

        var type = getType(classList);

        var form_data = new FormData();
        form_data.append("type", type);
        form_data.append("action", "updatePage");
        form_data.append("delete", "false");

        form_data.append("idPortfolio", idPortfolio );
        form_data.append("auteur", auteur );

        form_data.append("text", edit.textContent);


        if ( classList.contains("imageAccueil")) {

            var nomImg = ""
            var img = "";
            if ( edit.files.length > 0 ) {
                img = edit.files[0];
    
                var form_dataImg = new FormData();
                form_dataImg.append("file", img);
                form_dataImg.append("action", "uploadFiles");
    
                $.ajax({
                    type:"POST",
                    dataType: 'script',
                    contentType: false,
                    processData: false,
                    url:"../php/function.php",
                    data: form_dataImg
                });

                nomImg = img.name;
            }

            form_data.append("nomAttr", "imageAccueil")
            form_data.append("text", nomImg);
        }

        if ( classList.contains("competence"))
        {
            form_data.append("nomAttr", "competence");


            form_data.append("nouveau", edit.classList.contains("nouveau"));
            if ( edit.classList.contains("nouveau") ) edit.classList.remove("nouveau");

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));


            var nom = edit.querySelector(".nom").textContent;
            var description = edit.querySelector(".description").textContent;
            var lien = edit.querySelector(".lien").textContent.replaceAll("Lien :", "");

            var text = nom + ";" + description + ";" + lien + ";";
            form_data.append("text", text);
        } 

        if ( classList.contains("projet"))
        {

            form_data.append("nomAttr", "projet");

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));

            console.log(edit.querySelector(".nom").getAttribute("anciennevaleur"));

            var nom = edit.querySelector(".nom").textContent;
            var taille = edit.querySelector(".taille").textContent;
            var description = edit.querySelector(".description").textContent;
            var lien = edit.querySelector(".lien").textContent.replace("Lien", "");

            form_data.append("nouveau", edit.classList.contains("nouveau"));

            var nomImg = "";
            if ( edit.classList.contains("nouveau") )
            {
                edit.classList.remove("nouveau");

                var image = edit.querySelector(".image");

                var img = "";
                if ( image.files.length > 0 ) {
                    img = image.files[0];
        
                    var form_dataImg = new FormData();
                    form_dataImg.append("file", img);
                    form_dataImg.append("action", "uploadFiles");
        
                    $.ajax({
                        type:"POST",
                        dataType: 'script',
                        contentType: false,
                        processData: false,
                        url:"../php/function.php",
                        data: form_dataImg
                    });

                    nomImg = img.name;
                }

            } else {
                if ( edit.querySelector(".image") != null)
                    nomImg = edit.querySelector(".image").getAttribute("nom");
            }

            var text = nom + ";" + description + ";" + taille + ";" + lien + ";" + nomImg + ";";
            form_data.append("text", text);
        } 

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

        if ( classList.contains("age"))
        {
            form_data.append("nomAttr", "age");
            form_data.append("text", edit.textContent.replaceAll("(", "").replaceAll(")", ""));
        } 

        if ( classList.contains("nom-prenom"))
        {
            var nom = edit.textContent.split(" ")[0];
            var prenom = edit.textContent.split(" ")[1];

            form_data.append("text", nom);
            form_data.append("nomAttr", "nom");

            updatePage(form_data);

            form_data.append("text", prenom);
            form_data.append("nomAttr", "prenom");
        } 

        if ( classList.contains("diplome"))
        {
            form_data.append("nomAttr", "diplome");

        } 

        updatePage(form_data);
    }

    for ( var edit of lstDeleted ) {
        var classList = edit.classList;

        var type = getType(classList);

        var form_data = new FormData();
        form_data.append("type", type);
        form_data.append("action", "updatePage");

        form_data.append("idPortfolio", idPortfolio );
        form_data.append("auteur", auteur );

        form_data.append("text", "");


        if ( classList.contains("competence"))
        {
            form_data.append("nomAttr", "competence");

            form_data.append("delete", true);

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));
        } 

        if ( classList.contains("projet"))
        {
            form_data.append("nomAttr", "projet");

            form_data.append("delete", true);

            form_data.append("ancienneValeur", edit.querySelector(".nom").getAttribute("anciennevaleur"));
        } 

        updatePage(form_data);
    }

    if ( document.body.style.backgroundColor != "") {
        var form_data = new FormData();
        form_data.append("type", "infos");
        form_data.append("action", "updatePage");
        form_data.append("nomAttr", "bckCol");

        form_data.append("idPortfolio", idPortfolio );
        form_data.append("auteur", auteur );

        form_data.append("text", document.body.style.backgroundColor);

        console.log();
        
        updatePage(form_data);
    }

    location.reload();
    lstEditableTextChanged = new Set();
    lstDeleted = new Set();
}

function getType( classList ) {

    var type;

    if ( classList.contains("nom-portfolio") || classList.contains("description-site") || classList.contains("mail") || classList.contains("description-reseau") || classList.contains("imageAccueil")) {
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

function preventKeydown(event) {

    var selection = window.getSelection();
    var positionCursor = selection.getRangeAt(0);

    if (positionCursor.startOffset ===0 && event.key==="Backspace")
    {
        event.preventDefault();
    }
    if (positionCursor.endOffset ===0 && event.which===13) //enter key
    {
        event.preventDefault();
    }
}

function changeAccessibility() {
    var form_data = new FormData();
    form_data.append("idPortfolio", idPortfolio);
    form_data.append("action", "changeAccessibility");
    form_data.append("accessible", event.target.checked);
    $.ajax({
        type:"POST",
        dataType: 'script',
        contentType: false,
        processData: false,
        url:"./function.php",
        data: form_data,
        complete: function(data) {
            //console.log(data.responseText);
        }
    });
}

function getAccessibility() {
    var form_data = new FormData();
    form_data.append("idPortfolio", idPortfolio);
    form_data.append("action", "getAccessibility");
    $.ajax({
        type:"POST",
        dataType: 'script',
        contentType: false,
        processData: false,
        url:"./function.php",
        data: form_data,
        complete: function(data) {
            cbAccessible.checked = (data.responseText==0);
        }
    });
}
