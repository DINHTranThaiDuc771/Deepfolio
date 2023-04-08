var tabProfil;
var tabPortfolio;

var isSideBarOpened;

function Portfolio(nomUtilisateur, idPortfolio, nom, accessible) {
    this.nomUtilisateur = nomUtilisateur;
    this.idPortfolio = idPortfolio;
    this.nom = nom;
    this.accessible = accessible;
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
            var json = JSON.parse(data.responseText);

            for (var i=0; i<json.length; i++) {
                listPortfolios.push(new Portfolio(json[i].nomutilisateur,
                                                json[i].idportfolio,
                                                json[i].nomportfolio,
                                                json[i].accessible));
            }

            // Ajout des portfolios
            for (var p of listPortfolios) {
                addPortfolio(p);
            }
        }
    })
}

function addPortfolio(p) {
    var portfolios = document.getElementById("tab-portfolio");
    var portfolio = p;

    var ville;

    $.ajax({
        type:"POST",
        url:"./function.php",
        data:"action=getPage&idPortfolio="+portfolio.idPortfolio+"&type=cv",
        complete: function(data) {
            var json = JSON.parse(data.responseText);

            var jsonpage = JSON.parse(json[0].jsonpage);

            ville = "" + jsonpage.adresse;

            createPortfolio(portfolios, portfolio, ville);
        }
    })
}

function getKey(url) {
    return btoa(JSON.stringify(url));
}

function createPortfolio(portfolios, portfolio, ville) {
    var url = {};
    url.auteur = portfolio.nomUtilisateur;
    url.idPortfolio = portfolio.idPortfolio;


    var aTag = document.createElement("a");
    aTag.setAttribute("href", "../php/visualisation.php?cle=\"" + getKey(url) + "\"");
    aTag.classList.add("zIndex1");
    aTag.addEventListener("click",()=>console.log("aTagClicked"),true);
    
    var div0 = document.createElement("div");
    div0.classList.add("card");
    div0.classList.add("mb-3")
    div0.classList.add("w-100");

    var div1 = document.createElement("div");
    div1.classList.add("row");

    var redirection1 = document.createElement("a");
    redirection1.setAttribute("href", "../php/visualisation.php?cle=\"" + getKey(url) + "\"");

    var div2 = document.createElement("div");
    div2.classList.add("col-md-3");

    if (portfolio.nomUtilisateur == "admin") {
        var imgiframe = document.createElement("img");
        imgiframe.classList.add("img-fluid");
        imgiframe.setAttribute("src", "../img/add.png");
        imgiframe.setAttribute("style", "height:8rem;margin:auto;opacity:0.25;margin-top:40%;");
    } 
    else {
        var imgiframe = document.createElement("iframe");
        imgiframe.setAttribute("src","../php/visualisation.php?cle=\"" + getKey(url) + "\"");
        imgiframe.setAttribute("scrolling","no");
        imgiframe.setAttribute("style","pointer-events:none;border:none;width:400%;height:400%;transform:scale(0.25);transform-origin:0 0;display:flex;justify-content:center;align-items:center;");
    }

    var div3 = document.createElement("div");
    div3.classList.add("col-md-9");

    var div4 = document.createElement("div");
    div4.classList.add("row");
    div4.setAttribute("style","margin:auto;height:100%;");

    var redirection2 = document.createElement("a");
    redirection2.setAttribute("href", "../php/visualisation.php?cle=\"" + getKey(url) + "\"");

    var div5 = document.createElement("div");
    div5.classList.add("col-md-8");
    div5.setAttribute("style","margin:auto;text-align:center;");

    var div6 = document.createElement("div");
    div6.classList.add("col-md-8");
    
    var inputNom = document.createElement("INPUT");
    inputNom.setAttribute('type', 'text');
    inputNom.setAttribute('method', 'post');
    inputNom.setAttribute('name', 'renamePortfolio');
    inputNom.style.border = "none";
    inputNom.classList.add("card-title");
    inputNom.classList.add("text-center");
    inputNom.classList.add("zIndex2");
    inputNom.value = portfolio.nom;
    inputNom.addEventListener("click",(event)=>{
        event.preventDefault(); // prevent default behavior of the button
        event.stopPropagation();
    });
    inputNom.addEventListener("keyup", function(event) {

        if(event.key === "Enter") {
            if(inputNom.value == portfolio.nom || inputNom.value == ""){
                inputNom.value = portfolio.nom;
                return;
            }
            var form_data = new FormData();
            form_data.append("idPortfolio", portfolio.idPortfolio);
            form_data.append("action", "renamePortfolio");
            form_data.append("newName", inputNom.value);

            $.ajax({
                type:"POST",
                dataType: 'script',
                contentType: false,
                processData: false,
                url:"./function.php",
                data: form_data,
                complete: function(data) {
                    //refresh la page mais sur
                    portfolio.nom = inputNom.value;
                }
            });
        }
    });

    inputNom.addEventListener("focusout", function(event) {
        inputNom.value = portfolio.nom;
    });

    var div7 = document.createElement("div");
    div7.classList.add("col-md-8");

    var small = document.createElement("small");
    small.classList.add("text-muted");
    small.textContent = ville;

    var div8 = document.createElement("div");
    div8.classList.add("col-md-4");
    div8.setAttribute("style","margin:auto;text-align:center;");

    var btnCopy = document.createElement("button");
    btnCopy.classList.add("btn");
    btnCopy.classList.add("btn-primary");
    btnCopy.classList.add("zIndex2");
    btnCopy.style.backgroundColor = "#ffd285";

    var imagecopy = document.createElement("img");
    imagecopy.setAttribute("src", "../img/copy.png");

    btnCopy.addEventListener("click", function(event) {
        //TODO: copier le portfolio
        event.preventDefault(); // prevent default behavior of the button

        event.stopPropagation();

        let confirmation = "Voulez-vous vraiment copier ce portfolio ?";

        if (confirm(confirmation) == true)
        {
            var form_data = new FormData();
            form_data.append("idPortfolio", portfolio.idPortfolio);
            form_data.append("action", "copyPortfolio");

            $.ajax({
                type:"POST",
                dataType: 'script',
                contentType: false,
                processData: false,
                url:"./function.php",
                data: form_data,
                complete: function(data) {
                    //refresh la page mais sur
                    var elements = document.getElementsByClassName("card");

                    while(elements.length > 0){
                        elements[0].parentNode.removeChild(elements[0]); //faut pas utiliser for, car le length change
                    }
                    listPortfolios.splice(0,listPortfolios.length);
                    addPortfolios();
                }
            });
        }

        });
    var btnDl = document.createElement("button");
    btnDl.classList.add("btn");
    btnDl.classList.add("btn-primary");
    btnDl.classList.add("zIndex2");

    btnDl.id = "btnDl" + portfolio.idPortfolio;
    btnDl.addEventListener("click", function(event) {
        event.preventDefault(); // prevent default behavior of the button

        event.stopPropagation();
        var btnTele = event.target;
        if ( btnTele.nodeName == "IMG" )
        {
            btnTele = btnTele.parentElement;
        }

        var test = document.getElementById("frame");
        if (test != null)
            document.getElementById("frame").remove();
            

        var iframe = document.createElement("iframe");
        iframe.id = "frame";
        iframe.setAttribute("src","../php/visualisation.php?cle=\"" + getKey(url) + "\"&debug=true");
        iframe.setAttribute("style","display:none;");
        iframe.setAttribute("onload","custom()");

        iframe.setAttribute("name","frame");

        document.getElementsByTagName("body")[0].appendChild(iframe);

        frames['frame'].print();

    });
    
    var imgDl = document.createElement("img");
    imgDl.setAttribute("src", "../img/download.png");

    var btnDel = document.createElement("button");
    btnDel.classList.add("btn");
    btnDel.classList.add("btn-danger");
    btnDel.classList.add("zIndex2");
    btnDel.id = "btnDel"+portfolio.idPortfolio;
    btnDel.addEventListener("click", function(event) {
        event.preventDefault(); // prevent default behavior of the button

        event.stopPropagation();
        let confirmation = "Voulez-vous vraiment supprimer ce portfolio ?";

        if (confirm(confirmation) == true)
        {
            var form_data = new FormData();
            form_data.append("idPortfolio", portfolio.idPortfolio);
            form_data.append("action", "deletePortfolio");

            $.ajax({
                type:"POST",
                dataType: 'script',
                contentType: false,
                processData: false,
                url:"./function.php",
                data: form_data,
                complete: function() {
                    var btnSuppr = event.target;
                    var containerPortfolio = document.getElementById("tab-portfolio");

                    var divParent = btnSuppr.parentElement;
                    while (!divParent.classList.contains("zIndex1")) {
                        divParent = divParent.parentElement;
                    }
                    divParent.style.opacity = '0';
                    setTimeout(() => {
                        containerPortfolio.removeChild(divParent); 
                    }, 500);
                }
            });
        }

    });

    var imgDel = document.createElement("img");
    imgDel.setAttribute("src", "../img/trash.png");

    portfolios.appendChild(aTag);
    aTag.appendChild(div0);
    div0.appendChild(div1);
    div1.appendChild(div2);
    div2.appendChild(imgiframe);
    div1.appendChild(div3);
    div3.appendChild(div4);
    div4.appendChild(div5);
    div5.appendChild(div6);
    div6.appendChild(inputNom);
    redirection2.appendChild(div7);
    div5.appendChild(redirection2);
    div7.appendChild(small);
    div4.appendChild(div8);
    div8.appendChild(btnCopy);
    btnCopy.appendChild(imagecopy);
    div8.appendChild(btnDl);
    btnDl.appendChild(imgDl);
    div8.appendChild(btnDel);
    btnDel.appendChild(imgDel);
}

function custom(){
    document.getElementById("frame").contentWindow.document.getElementById("smallp").style.textAlign = "justify";
}

window.onload = () => {

    var btnProfil       = document.getElementById("btn-profil");
    var btnPortfolios   = document.getElementById("btn-portfolios");
    tabProfil       = document.getElementById("tab-profil");
    tabPortfolio    = document.getElementById("tab-portfolio");


    btnProfil     .addEventListener("click",function(){changerTab("profil");},false);
    btnPortfolios .addEventListener("click",function(){changerTab("portfolios");},false);

    var btnMenu         = document.getElementById("icon-toggle-menu");

    isSideBarOpened     = false;

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