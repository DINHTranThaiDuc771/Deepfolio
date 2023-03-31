

window.onload = () => {
var btnProfil       = document.getElementById("btn-profil");
var btnPortfolios   = document.getElementById("btn-portfolios");
var btnDeconnecter  = document.getElementById("btn-deconnecter");
var tabProfil       = document.getElementById("tab-profil");
var tabPortfolio    = document.getElementById("tab-portfolio");
btnProfil     .addEventListener("click",function(){changerTab("profil");},false);
btnPortfolios .addEventListener("click",function(){changerTab("portfolios");},false);
btnDeconnecter.addEventListener("click",deconnecter,false);
var deconnecter = function deconnecter() {
}

var btnMenu         = document.getElementById("icon-toggle-menu");

var x = window.matchMedia("(max-width: 700px)")
if (!x.matches)
{
    btnMenu.style.display = "none";
    document.getElementById("sidebar").style.width = "240px";

}
else 
{
    btnMenu.style.display = "block";
    document.getElementById("sidebar").style.width = "0px";

}

//Toggle menu
var toggle          = false;
btnMenu.addEventListener("click",function(){toggleMenu();},false);

function toggleMenu(){
    console.log(toggle);
    toggle = !toggle;
    if(toggle)
    {
        document.getElementById("sidebar").style.width = "240px";

    }
    else
    {
        document.getElementById("sidebar").style.width = "0";
    }
} 
function changerTab(tab){

    if (tab==="profil") {
        console.log(tab);
        tabProfil.style.display = "flex";
        tabPortfolio.style.display ="none";
    }
    if (tab==="portfolios") {
        console.log(tab);
        tabProfil.style.display = "none";
        tabPortfolio.style.display ="block";
    }
}
}