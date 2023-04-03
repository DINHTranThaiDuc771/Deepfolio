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
    constructor (nom, entreprise) {
        this.nom = nom;
        this.entreprise = entreprise;
    }
}

class Projet {
    constructor(nom, taille, description, lien, image) {
      this.nom = nom;
      this.taille = taille;
      this.description = description;
      this.lien = lien;
      this.image = image;
    }
}

class Competence {
    constructor(nom, description, lien) {
      this.nom = nom;
      this.description = description;
      this.lien = lien;
    }
}




var currentTab = 3; // Current tab is set to be the first tab (0)
var nbTab = 4;
var tabElements = new Array();


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
            opt.value = elmt.id;

            lienProjet.add(opt);
        }
    }
}

function nextPrev(n) {

    var x = document.querySelectorAll(" .tab");

    x[currentTab].style.display = "none";

    var tabInput = x[currentTab].querySelectorAll("input");

    Array.prototype.slice.call(tabInput).forEach((input) => {
        input.required = false;
    });

    currentTab = currentTab + n;

    var tabRequired = new Array();

    if (currentTab == 0 ) 
    {
        tabRequired[0] = true;
        tabRequired[1] = true;
        tabRequired[2] = true;
        tabRequired[3] = true;
        tabRequired[4] = false;
        tabRequired[5] = true;
        tabRequired[6] = false;
        tabRequired[7] = false;
    }

    if (currentTab == 1 ) 
    {
        tabRequired[0] = false;
        tabRequired[1] = false;
        tabRequired[2] = false;
        tabRequired[3] = false;
    }  

    var tabInput = x[currentTab].querySelectorAll("input");

    var cpt = 0;
    Array.prototype.slice.call(tabInput).forEach((input) => {
        if (tabRequired[cpt] != undefined)
            input.required = tabRequired[cpt++];
    });

    showTab(currentTab);
}

function ajouterTab(event) {

    var divFormulaires = event.target.parentElement;

    var tabChips = divFormulaires.getElementsByClassName("tableauElmt")[0];
     
    while ( tabChips == undefined) {
        divFormulaires = divFormulaires.parentElement;
        tabChips = divFormulaires.getElementsByClassName("tableauElmt")[0];
    }

    console.log(divFormulaires);

    console.log(tabChips);

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
    

    if ( currentTab == 2 ) 
        tabElements[tabElements.length] = new Travail(tabText[0], tabText[1]);
    
    if ( currentTab == 3 ) {

        var inputFile = document.getElementById("typePhotoprojet");

        var img = "";

        if ( inputFile.files.length > 0 ) {
            img = inputFile.files[0];
        }

        inputFile.value = "";

        tabElements[tabElements.length] = new Projet(tabText[0], tabText[1], tabText[2], tabText[3], img);
    }
    
    if ( currentTab == 4 ) {

        var lienProjet = document.getElementById("lienProjet");
        var lienNonProjet = document.getElementById("lienNonProjet");

        var lien;
        if ( lienNonProjet.value = "") {
            lien = lienProjet.value;
        } else {
            lien = lienNonProjet.value;
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

        if ( currentTab == 3 ) {
            console.log(elmt.image);
            if ( elmt.image != "") {

                var image = document.createElement("img");
                image.src = URL.createObjectURL(elmt.image);
                image.width = "96";
                image.height = "96";
                image.alt = "Image de la compétence";

                divChips.appendChild(image);
            }
        }

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

    if (!form.checkValidity() && currentTab != nbTab) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        form.classList.remove('was-validated');
        nextPrev(indexSuivant, event.target);
        return;
    }

    form.classList.add('was-validated');
}

function gereLien( elmt1, elmt2 ) {

    if ( elmt1.value != "") {
        elmt2.disabled = true;
    } else {
        elmt1.disabled = false;
        elmt2.disabled = false;
    }
}



window.onload = () => {

    showTab(currentTab);

    const tabBtnPrec = document.querySelectorAll(" .precedent");
    const tabBtnSuiv = document.querySelectorAll(" .suivant");
    const tabBtnAjouter = document.querySelectorAll(" .ajouter");

    const form = document.getElementById("formCreerPortfolio");

    const lienProjet = document.getElementById("lienProjet");
    const lien = document.getElementById("lienNonProjet");


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
            valider(event, form, 1);     
          }
    });


    form.addEventListener('submit', (event) => {
        valider(event, form, 1);            
    }, false);

    lien.addEventListener("input", function(){ gereLien(lien, lienProjet); });

    lienProjet.addEventListener("change", function(){ gereLien(lienProjet, lien); });
}