

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

// var x = window.matchMedia("(max-width: 700px)")
// if (!x.matches)
// {
//     btnMenu.style.display = "none";
//     document.getElementById("sidebar").style.width = "240px";

// }
// else 
// {
//     btnMenu.style.display = "block";
//     document.getElementById("sidebar").style.width = "0px";

// }

//isSideBarOpened menu
var isSideBarOpened          = false;
btnMenu.addEventListener("click",function(){toggleMenu();},false);

function toggleMenu(){
    console.log(isSideBarOpened);
    isSideBarOpened = !isSideBarOpened;
    if(isSideBarOpened)
    {
        document.getElementById("sidebar").style.transform = "translateX(0)";

    }
    else
    {
        document.getElementById("sidebar").style.transform  = "translateX(-240px)";
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