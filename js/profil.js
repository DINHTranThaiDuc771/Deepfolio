var tabProfil;
var tabPortfolio;

var isSideBarOpened;

function toggleMenu(){
        
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
        tabProfil.style.display = "flex";
        tabPortfolio.style.display ="none";
    }
    if (tab==="portfolios") {
        tabProfil.style.display = "none";
        tabPortfolio.style.display ="block";
    }
}

window.onload = () => {

    var btnProfil       = document.getElementById("btn-profil");
    var btnPortfolios   = document.getElementById("btn-portfolios");
    tabProfil       = document.getElementById("tab-profil");
    tabPortfolio    = document.getElementById("tab-portfolio");


    btnProfil     .addEventListener("click",function(){changerTab("profil");},false);
    btnPortfolios .addEventListener("click",function(){changerTab("portfolios");},false);

    var btnMenu         = document.getElementById("icon-toggle-menu");

    isSideBarOpened          = false;

    btnMenu.addEventListener("click",function(){toggleMenu();},false);

}

function changerSvg(txt) {
    var x = 35;
    var y = 70;

    var classSvg = document.querySelectorAll(".svg");

    txt = txt.charAt(0);

    var cpt = 0;
    for ( var svg of classSvg) {
        var el = document.createElementNS("http://www.w3.org/2000/svg", "text");
        el.textContent = txt.toUpperCase();
        el.setAttributeNS(null, 'x', x);
        el.setAttributeNS(null, 'y', y);
        el.setAttribute("fill", "white");

        if ( cpt != 0 )
        {
            el.setAttribute("font-size", "80px");
        }

        svg.appendChild(el);

        x += 44;
        y += 62;
        cpt++;
    }
}