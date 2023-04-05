class Reseau {
    constructor(nom, lien) {
      this.nom = nom;
      this.lien = lien;
    }
}

class Etude {
    constructor (nom, etablissement, annee) {
        this.nom = nom;
        this.etablissement = etablissement;
        this.annee = annee;

    }
}

class Travail {
    constructor (nom, entreprise, description, dateDebut, dateFin) {
        this.nom = nom;
        this.entreprise = entreprise;
        this.description = description;
        this.dateDebut = dateDebut;
        this.dateFin = dateFin;
    }
}

class Projet {
    constructor(nom, description, taille, lien, image) {
        this.nom = nom;
        this.description = description;
        this.taille = taille;
        this.lien = lien;
        this.image = image;
    }
}

class Competence {
    constructor(nom, description, lien, projet) {
        this.nom = nom;
        this.description = description;
        this.lien = lien;
        this.projet = projet;
    }
}

var currentTab = 0; // Current tab is set to be the first tab (0)
var nbTab = 4;
var tabElements = new Array();
var mapReseaux;

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";

    if ( currentTab == 4 ) 
    {
        var lienProjet = document.getElementById("lienProjet");

        for ( var opt of lienProjet.options) {
            lienProjet.remove(0);
        }

        var option = document.createElement("option");
        option.label = "";

        lienProjet.add(option);
        
        for ( var elmt of tabElements) {
            if (!(elmt instanceof Projet)) continue;

            var opt = document.createElement("option");
            opt.label = elmt.nom;
            opt.value = elmt.nom;

            lienProjet.add(opt);
        }
    }
}

var avancement = 0;

function nextPrev(n) {

    var x = document.querySelectorAll(" .tab");

    x[currentTab].style.display = "none";

    var tabInput = x[currentTab].querySelectorAll("input");

    Array.prototype.slice.call(tabInput).forEach((input) => {
        input.required = false;
    });

    var previousTab = currentTab;

    currentTab = currentTab + n;

    var tabRequired = new Array();

    if (currentTab == 0 ) 
    {
        tabRequired[0] = true;
        tabRequired[1] = true;
        tabRequired[2] = true;
        tabRequired[3] = true;
        tabRequired[4] = false;
        tabRequired[5] = false;
        tabRequired[6] = false;
    }

    if (currentTab == 1 ) 
    {
        tabRequired[0] = false;
        tabRequired[1] = false;
        tabRequired[2] = false;
        tabRequired[3] = false;
    }  

    if (currentTab == nbTab ) 
    {
        tabRequired[0] = false;
        tabRequired[1] = false;
        tabRequired[2] = false;
        tabRequired[3] = true;
    }

    var tabInput = x[currentTab].querySelectorAll("input");

    var cpt = 0;
    Array.prototype.slice.call(tabInput).forEach((input) => {
        if (tabRequired[cpt] != undefined)
            input.required = tabRequired[cpt++];
    });

    updateProgressbar(currentTab-previousTab);

    showTab(currentTab);
}

function updateProgressbar(n){
    if(n < 0){
        avancement-=20;
    }else{
        avancement+=20;
    }
    $(".progress-bar").animate({
        width: avancement+"%",
    }, 1500);
}

function ajouterTab(event) {

    var divFormulaires = event.target.parentElement;

    var tabChips = divFormulaires.getElementsByClassName("tableauElmt")[0];

    while ( tabChips == undefined) {
        divFormulaires = divFormulaires.parentElement;
        tabChips = divFormulaires.getElementsByClassName("tableauElmt")[0];
    }

    var tabInput = divFormulaires.querySelectorAll("input");

    var tabText = new Array();

    var vide = false;
    Array.prototype.slice.call(tabInput).forEach((input) => {
        if ( input.type != "file") {

            tabText[tabText.length] = input.value;
            
            if ( ( input.value === "" || input.value == null ) && input.classList.contains("require") ) vide = true;

            input.disabled = false;
        }
    });

    if ( vide ) {
        return;
    } else {
        Array.prototype.slice.call(tabInput).forEach((input) => {
            if ( input.type != "file") {
                input.value = "";
            }
        });
    }

    if ( currentTab == 0 ) 
        tabElements[tabElements.length] = new Reseau(tabText[0], tabText[1]);

    if ( currentTab == 1 ) 
        tabElements[tabElements.length] = new Etude(tabText[0], tabText[1], tabText[2]);
    

    if ( currentTab == 2 ) {
        var textPoste = document.getElementById("typeDescriptionPoste"); 
        description = textPoste.value;

        textPoste.value = "";

        tabElements[tabElements.length] = new Travail(tabText[0], tabText[1], description, tabText[2], tabText[3] );
    }
    
    if ( currentTab == 3 ) {

        var inputFile = document.getElementById("typePhotoprojet");

        var img = "";

        if ( inputFile.files.length > 0 ) {
            img = inputFile.files[0];

            var form_data = new FormData();
            form_data.append("file", img);
            form_data.append("action", "uploadFiles");

            $.ajax({
                type:"POST",
                dataType: 'script',
                contentType: false,
                processData: false,
                url:"../php/function.php",
                data: form_data
            });

            tabElements[tabElements.length] = new Projet(tabText[0], tabText[1], tabText[2], tabText[3], img.name);   
        } else {
            tabElements[tabElements.length] = new Projet(tabText[0], tabText[1], tabText[2], tabText[3], img);
        }

        inputFile.value = "";
    }
    
    if ( currentTab == 4 ) {

        var lienProjet = document.getElementById("lienProjet");

        var lien;
        if ( tabText[2] == "") {
            lien = "#" + lienProjet.value;
        } else {
            lien = tabText[2];
        }

        lienProjet.disabled = false;
        lienProjet.selectedIndex = 0;

        tabElements[tabElements.length] = new Competence(tabText[0], tabText[1], lien);
    }
    

    maj(tabChips);
}

function maj( area ) {

    area.innerHTML = "";

    for ( var elmt of tabElements ) {
        
        if ( currentTab == 0 && !(elmt instanceof Reseau)     ) continue;
        if ( currentTab == 1 && !(elmt instanceof Etude)      ) continue;
        if ( currentTab == 2 && !(elmt instanceof Travail)    ) continue;
        if ( currentTab == 3 && !(elmt instanceof Projet)     ) continue;
        if ( currentTab == 4 && !(elmt instanceof Competence) ) continue;


        var divChips = document.createElement("div");
        divChips.classList.add("chip");
        divChips.textContent = elmt.nom;

        var spanChips = document.createElement("span");
        spanChips.classList.add("closebtn");
        spanChips.textContent = "x";
        spanChips.value = elmt;

        spanChips.addEventListener("click", function(event){
            tabElements = tabElements.filter(elmtTab => (elmtTab != event.target.value));
                
            maj(area);
         });

        divChips.appendChild(spanChips);

        area.appendChild(divChips);
    };
}

function valider(event, form, indexSuivant)
{

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        if ( currentTab == nbTab)
        {
            terminer();
        } else {
            form.classList.remove('was-validated');
            nextPrev(indexSuivant, event.target);
        }

        return;
    }

    form.classList.add('was-validated');
}

function terminer(){

    updateProgressbar(1);

    const inputs = document.getElementById("formCreerPortfolio").elements;
    var tabReseaux     = new Array();
    var tabDiplomes    = new Array();
    var tabParcourss   = new Array();
    var tabProjets     = new Array();
    var tabCompetences = new Array();

    for(var element of tabElements) {
        if(element instanceof Reseau) {
            tabReseaux.push(element);
            continue;
        }
        
        if(element instanceof Etude) {
            tabDiplomes.push(element);
            continue;
        }

        if(element instanceof Travail) {
            tabParcourss.push(element);
            continue;
        }

        if(element instanceof Projet) {
            tabProjets.push(element);
            continue;
        }
        
        if(element instanceof Competence) {
            tabCompetences.push(element);
            continue;
        }
    }

    var nom          = inputs["nom"].value;
    var prenom       = inputs["prenom"].value;
    var age          = inputs["age"].value;
    var lienCv       = inputs["lienCv"].value;
    var presentation = inputs["presentation"].value;
    var adresse      = inputs["adresse"].value;

    let json =  {
        "nom" : nom, "prenom" : prenom, "age" : age, "lienCv" : lienCv, 
        "presentation" : presentation, "adresse" : adresse, "reseaux" : tabReseaux, 
        "diplomes" : tabDiplomes, "parcours" : tabParcourss, "projets" : tabProjets, 
        "competences" : tabCompetences
    };

    var jsonString = JSON.stringify(json);
    $.cookie('portfolio', jsonString, { expires: 1 });

}


function gereLien( elmt1, elmt2 ) {

    if ( elmt1.value != "") {
        elmt2.disabled = true;
    } else {
        elmt1.disabled = false;
        elmt2.disabled = false;
    }
}

function initMapReseaux() {

    mapReseaux.set("linkedin", "https://www.linkedin.com/in/");
    mapReseaux.set("facebook", "https://www.facebook.com/");
    mapReseaux.set("discord", "https://discord.com/");
    mapReseaux.set("signal", "https://signal.org/fr/");
    mapReseaux.set("telegram", "https://telegram.org/");
    mapReseaux.set("stackoverflow", "https://stackoverflow.com/");
    mapReseaux.set("instagram", "https://www.instagram.com/");    
    mapReseaux.set("twitter", "https://twitter.com/");
    mapReseaux.set("github", "https://github.com/");
    mapReseaux.set("youtube", "https://www.youtube.com/");
    mapReseaux.set("twitch", "https://www.twitch.tv/");
}


window.onload = () => {

    mapReseaux = new Map();
    initMapReseaux();

    showTab(currentTab);

    const tabBtnPrec        = document.querySelectorAll(" .precedent");
    const tabBtnSuiv        = document.querySelectorAll(" .suivant");
    const tabBtnAjouter     = document.querySelectorAll(" .ajouter");

    const form = document.getElementById("formCreerPortfolio");

    const lienProjet = document.getElementById("lienProjet");
    const lien = document.getElementById("lienNonProjet");

    document.getElementById("typeReseau").addEventListener("input", (e)=>{ 
        var reseau = e.target.value.toLowerCase();
        if(mapReseaux.has(reseau)){
            document.getElementById('typeLien').value = mapReseaux.get(reseau);
        }else{
            document.getElementById('typeLien').value = "";
        } 
    });

    Array.prototype.slice.call(tabBtnSuiv).forEach((btnSuivant) => {
        btnSuivant.addEventListener("click", (event) => {
            valider(event, form, 1);
        });
    });

    Array.prototype.slice.call(tabBtnPrec).forEach((btnPrecedent) => {
        btnPrecedent.addEventListener("click", (event) => {
            nextPrev(-1);
        });
    });

    Array.prototype.slice.call(tabBtnAjouter).forEach((btnAjouter) => {
        btnAjouter.addEventListener("click", ajouterTab);
    });

    addEventListener("keypress", (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            event.stopPropagation();
            valider(event, form, 1);     
        }
    });


    form.addEventListener('submit', (event) => {
        valider(event, form, 1);            
    }, false);

    lien.addEventListener("input", function(){ gereLien(lien, lienProjet); });

    lienProjet.addEventListener("change", function(){ gereLien(lienProjet, lien); });
}