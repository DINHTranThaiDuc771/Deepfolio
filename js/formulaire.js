class Competence {
    constructor(nom, description, lien) {
      this.nom = nom;
      this.description = description;
      this.lien = lien;
    }
}


var currentTab = 2; // Current tab is set to be the first tab (0)
var tabCompetences = new Array();   



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
    }

    if (currentTab == 1 ) 
    {
        tabRequired[0] = true;
        tabRequired[1] = true;
    }    

    var tabInput = x[currentTab].querySelectorAll("input");

    var cpt = 0;
    Array.prototype.slice.call(tabInput).forEach((input) => {
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
        input.value = "";
        if ( input.value == "" ) return;
    });



    tabCompetences[tabCompetences.length] = new Competence(tabText[0], tabText[1], tabText[2]);

    maj(divFormulaires.getElementsByClassName("tableauComp")[0]);
}

function maj( area ) {

    area.innerHTML = "";

    

    Array.prototype.slice.call(tabCompetences).forEach((comp) => {
        
        var divChips = document.createElement("div");
        divChips.classList.add("chip");
        divChips.textContent = comp.nom;

        var spanChips = document.createElement("span");
        spanChips.classList.add("closebtn");
        spanChips.textContent = "x";

        divChips.appendChild(spanChips);

        area.appendChild(divChips);
    });
}

function valider(event, form, indexSuivant)
{

    if (!form.checkValidity()) {
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