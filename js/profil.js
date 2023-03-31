

window.onload = () => {
var btnProfil       = document.getElementById("btn-profil");
var btnPortfolios   = document.getElementById("btn-portfolios");
var btnDeconnecter  = document.getElementById("btn-deconnecter");
var tabProfil       = document.getElementById("tab-profil");
var tabPortfolio    = document.getElementById("tab-portfolio");
btnProfil     .addEventListener("click",function(){changerTab("profil")},false);
btnPortfolios .addEventListener("click",function(){changerTab("portfolios")},false);
btnDeconnecter.addEventListener("click",deconnecter);
var deconnecter = function deconnecter() {

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