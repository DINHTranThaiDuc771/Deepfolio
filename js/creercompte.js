var currentTab = 0; // Current tab is set to be the first tab (0)
var nbTab = 1;
var avancement = 0;
 // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
}

function nextPrev(n) {

    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:

    var previoustab = currentTab;
    currentTab = currentTab + n;


    var required;

    required = currentTab == 1;

    document.getElementById("typePrenom").classList.remove("active");
    document.getElementById("typeNom").classList.remove("active");

    document.getElementById("typePrenom").required = required;
    document.getElementById("typeNom").required = required;
    document.getElementById("mentionsLegales").required = required;



    showTab(currentTab);

    updateProgressbar(currentTab - previoustab);

}

function updateProgressbar(n){
    if(n < 0){
        avancement-=50;
    }else{
        avancement+=50;
    }
    $(".progress-bar").animate({
        width: avancement+"%",
    }, 1500);
}

function valider(event, form)
{
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    } else {

        form.classList.remove('was-validated');
        nextPrev(1);
        return;
    }

    form.classList.add('was-validated');
}

function verifierNom(event, form) {
    var nomUtilisateur = document.getElementById("typeNomUtilisateur").value;
    console.log("verifier nom utilisateur " + nomUtilisateur);
    $.ajax({
        type:"POST",
        url:"./function.php",
        data:"action=userExists&username=" + nomUtilisateur,
        complete: function(data) {
            console.log(data.responseText);
            if (data.responseText.includes("true"))
            {
                alert("Nom déjà utilisé");
            }
            else
            {
                valider(event, form);
            }
        }
    });   
}

window.onload = function(){

    var btnPrecedent = document.getElementById("precedent");
    var btnSuivant = document.getElementById("suivant");

    var form = document.getElementById("formCreerCompte");

    btnPrecedent.addEventListener("click", function() { nextPrev(-1); });

    btnSuivant.addEventListener("click", (event) => {
            verifierNom(event, form);
    }, false);

    form.addEventListener('submit', (event) => {
        valider(event, form);            
    }, false);

    addEventListener("keypress", (event) => {
        if (event.key === 'Enter') {
            verifierNom(event, form);   
        }
    });

    showTab(currentTab);
}