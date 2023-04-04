var tabProfil;
var tabPortfolio;

var isSideBarOpened;


function Portfolio(nomUtilisateur, idPortfolio, nom, accessible, ville) {
    this.nomUtilisateur = nomUtilisateur;
    this.idPortfolio = idPortfolio;
    this.nom = nom;
    this.accessible = accessible;
    this.ville = ville;
}

var listPortfolios = [];


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

function addPortfolios() {
    // Récupération des portfolios de l'utilsateur
    $.ajax({
        type:"POST",
        url:"./function.php",
        data:"action=getPortfolios",
        complete: function(data) {
            console.log(data.responseText)
            var json = JSON.parse(data.responseText);

            for (var i=0; i<json.length; i++) {
                listPortfolios.push(new Portfolio(json[i].nomutilisateur,
                                                json[i].idportfolio,
                                                json[i].nomportfolio,
                                                json[i].accessible,
                                                json[i].ville));
            }

            console.log("==="+listPortfolios);

            // Ajout des portfolios
            for (var p of listPortfolios) {
                console.log(listPortfolios.indexOf(p)+":"+p.nomUtilisateur);
                console.log(listPortfolios.indexOf(p)+":"+p.nomPortfolio);
                console.log(listPortfolios.indexOf(p)+":"+p.ville);
                addPortfolio(p);
            }
        }
    })
}

function addPortfolio(p) {
    var portfolios = document.getElementById("tab-portfolio");
    var portfolio = p;

    var div0 = document.createElement("div");
    div0.classList.add("card");
    div0.classList.add("mb-3")
    div0.classList.add("w-100");

    var div1 = document.createElement("div");
    div1.classList.add("row");

    var div2 = document.createElement("div");
    div2.classList.add("col-md-3");

    var img = document.createElement("img");
    img.classList.add("img-fluid");
    img.classList.add("rounded-start");
    img.setAttribute("src", "../img/portfolio.jpeg");
    img.setAttribute("width", "100%");

    var div3 = document.createElement("div");
    div3.classList.add("col-md-9");

    var div4 = document.createElement("div");
    div4.classList.add("row");
    div4.setAttribute("style","margin:auto;height:100%;");

    var div5 = document.createElement("div");
    div5.classList.add("col-md-8");
    div5.setAttribute("style","margin:auto;text-align:center;");

    var div6 = document.createElement("div");
    div6.classList.add("col-md-8");
    
    var h5 = document.createElement("h5");
    h5.classList.add("card-title");
    h5.textContent = portfolio.nom;

    var div7 = document.createElement("div");
    div7.classList.add("col-md-8");

    var small = document.createElement("small");
    small.classList.add("text-muted");
    small.textContent = "Ville" + portfolio.ville;

    var div8 = document.createElement("div");
    div8.classList.add("col-md-4");
    div8.setAttribute("style","margin:auto;text-align:center;");

    var btnDl = document.createElement("button");
    btnDl.classList.add("btn");
    btnDl.classList.add("btn-primary");
    
    var imgDl = document.createElement("img");
    imgDl.setAttribute("src", "../img/download.png");

    var btnDel = document.createElement("button");
    btnDel.classList.add("btn");
    btnDel.classList.add("btn-danger");

    var imgDel = document.createElement("img");
    imgDel.setAttribute("src", "../img/trash.png");

    portfolios.appendChild(div0);
    div0.appendChild(div1);
    div1.appendChild(div2);
    div2.appendChild(img);
    div1.appendChild(div3);
    div3.appendChild(div4);
    div4.appendChild(div5);
    div5.appendChild(div6);
    div6.appendChild(h5);
    div5.appendChild(div7);
    div4.appendChild(div8);
    div8.appendChild(btnDl);
    btnDl.appendChild(imgDl);
    div8.appendChild(btnDel);
    btnDel.appendChild(imgDel);

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

    addPortfolios();
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