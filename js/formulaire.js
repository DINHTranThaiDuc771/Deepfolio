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
    constructor(nom, taille, description, lien) {
      this.nom = nom;
      this.taille = taille;
      this.description = description;
      this.lien = lien;
    }
}

class Competence {
    constructor(nom, description, lien) {
      this.nom = nom;
      this.description = description;
      this.lien = lien;
    }
}




var currentTab = 0; // Current tab is set to be the first tab (0)
var nbTab = 4;
var tabElements = new Array();


function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
}

function nextPrev(n, btn) {

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
        console.log(input);
        console.log(tabRequired[cpt]);

        if (tabRequired[cpt] != undefined)
            input.required = tabRequired[cpt++];
    });

    showTab(currentTab);
}

function ajouterTab(event) {

    var divFormulaires = event.target.parentElement;

    var tabInput = divFormulaires.querySelectorAll("input");

    var tabText = new Array();

    var vide = false;
    Array.prototype.slice.call(tabInput).forEach((input) => {
        tabText[tabText.length] = input.value;
        
        if ( input.value === "" || input.value == null) vide = true;

        input.value = "";
    });

    if ( vide ) return;

    if ( currentTab == 0 ) 
        tabElements[tabElements.length] = new Reseau(tabText[0], tabText[1]);

    if ( currentTab == 1 ) 
        tabElements[tabElements.length] = new Etude(tabText[0], tabText[1], tabText[2]);
    

    if ( currentTab == 2 ) 
        tabElements[tabElements.length] = new Travail(tabText[0], tabText[1]);
    
    if ( currentTab == 3 )
        tabElements[tabElements.length] = new Projet(tabText[0], tabText[1], tabText[2], tabText[3]);
    
    if ( currentTab == 4 )
        tabElements[tabElements.length] = new Competence(tabText[0], tabText[1], tabText[2]);
    

    maj(divFormulaires.getElementsByClassName("tableauElmt")[0]);
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

        spanChips.addEventListener("click", function(){
            tabElements = tabElements.filter(elmt => (elmt != elmt ));
    
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



window.onload = () => {

    showTab(currentTab);

    var tabBtnPrec = document.querySelectorAll(" .precedent");
    var tabBtnSuiv = document.querySelectorAll(" .suivant");
    var tabBtnAjouter = document.querySelectorAll(" .ajouter");

    var form = document.getElementById("formCreerPortfolio");

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


    form.addEventListener('submit', (event) => {
        valider(event, form);            
    }, false);

}