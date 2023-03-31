var currentTab = 0; // Current tab is set to be the first tab (0)
var nbTab = 1;
showTab(currentTab); // Display the current tab

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
    currentTab = currentTab + n;


    var required;

    required = currentTab == 1;
   
    document.getElementById("typePrenom").classList.remove("active");
    document.getElementById("typeNom").classList.remove("active");

    document.getElementById("typePrenom").required = required;
    document.getElementById("typeNom").required = required;

    showTab(currentTab);
}

function valider(event, form)
{


    if (!form.checkValidity() && currentTab != nbTab) {
        event.preventDefault();
        event.stopPropagation();
    } else {
        form.classList.remove('was-validated');
        nextPrev(1);
        return;
    }

    form.classList.add('was-validated');
}



window.onload = function(){

    var btnPrecedent = document.getElementById("precedent");
    var btnSuivant = document.getElementById("suivant");

    var form = document.getElementById("formCreerCompte");

    btnPrecedent.addEventListener("click", function() { nextPrev(-1); });

    btnSuivant.addEventListener("click", (event) => {
        var nomUtilisateur = document.getElementById("typeNomUtilisateur").value;
        $.ajax({
            type:"POST",
            url:"./function.php",
            data:"action=userExists&username=" + nomUtilisateur,
            complete: function(data) {
                if (data.responseText.includes("true"))
                {
                    alert("Nom déjà utilisé");
                }
                else
                {
                    valider(event, form);
                }
            }
        })        
    }, false);

    form.addEventListener('submit', (event) => {
        valider(event, form);            
    }, false);

    addEventListener("keypress", (event) => {
        if (event.key === 'Enter') {
            valider(event, form, 1);     
          }
    });


}