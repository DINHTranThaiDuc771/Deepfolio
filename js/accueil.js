var isSideBarOpened = false;

function Message(nomUtilisateur, nom, prenom, mail, objet, text) {
    this.nomUtilisateur = nomUtilisateur;
    this.nom = nom;
    this.prenom = prenom;
    this.mail = mail;
    this.objet = objet;
    this.text = text;
    this.btn = "Supprimer";
}

var listMessages = [];

function Portfolio(nomUtilisateur, idPortfolio, nom, accessible) {
    this.nomUtilisateur = nomUtilisateur;
    this.idPortfolio = idPortfolio;
    this.nom = nom;
    this.accessible = accessible;
}

var listPortfolios = [new Portfolio("admin", 0, "Créer un portfolio", false)];

function clickBtnMail() {
    isSideBarOpened = !isSideBarOpened;


    if (isSideBarOpened) {
        document.getElementById("sidebar").style.transform = "translateX(0)";
    }
    else {
        document.getElementById("sidebar").style.transform = "translateX(-240px)";
    }

}

function searchPortfolio() {
    var container = document.getElementById("portfolios");

    while (container.firstChild) {
        container.removeChild(container.lastChild);
    }

    var search = document.getElementById("search-bar").value.toUpperCase();

    console.log(listPortfolios)

    for (var p of listPortfolios) {
        if (p.nomUtilisateur == "admin") {
            addPortfolio(p, 0);
        }
    }

    if (search != "") {
        var cpt = 1;
        for (var p of listPortfolios) {
            if (p.nom.toUpperCase().includes(search) && p.nomUtilisateur != "admin") {
                addPortfolio(p, cpt);
                cpt++;
            }
        }
    }
    else {
        while (container.firstChild) {
            container.removeChild(container.lastChild);
        }

        for (var p of listPortfolios) {
            addPortfolio(p, listPortfolios.indexOf(p));
        }
    } 
}

function addPortfolio(p, i) {
    var portfolios = document.getElementById("portfolios");
    var portfolio = p;

    var div0;
    var id = parseInt((i / 3 + 1));

    if (i % 3 == 0) {
        div0 = document.createElement("div");
        div0.id = "rowPortfolio" + id;
        div0.classList.add("row");
        div0.classList.add("my-5");
    }
    else {
        div0 = document.getElementById("rowPortfolio" + id);
    }

    var div1 = document.createElement("div");
    div1.classList.add("col-md-4");
    div1.id = "pf" + portfolio.idPortfolio;

    var div2 = document.createElement("div");
    div2.classList.add("card");

    var div3 = document.createElement("div");
    div3.classList.add("bg-image");
    div3.classList.add("hover-overlay");
    div3.classList.add("ripple");
    div3.setAttribute("data-mdb-ripple-color", "light");

    var img = document.createElement("img");
    img.classList.add("img-fluid");
    if (p.nomUtilisateur == "admin")
        img.setAttribute("src", "../img/add.png");
    else
        img.setAttribute("src", "../img/portfolio.jpeg");

    var a = document.createElement("a");
    a.setAttribute("href", "#");

    var div4 = document.createElement("div");
    div4.classList.add("card-body");

    var h5 = document.createElement("h5");
    h5.classList.add("card-title");
    h5.textContent = portfolio.nom;

    var p = document.createElement("p");
    p.classList.add("card-text");

    portfolios.appendChild(div0);
    div0.appendChild(div1);
    div1.appendChild(div2);
    div2.appendChild(div3);
    div3.appendChild(img);
    div3.appendChild(a);
    div2.appendChild(div4);
    div4.appendChild(h5);
}

function addMessage(m) {
    var messages = document.getElementById("messages");
    var message = m;

    var div = document.createElement("div");
    div.classList.add("bloc-message");

    var divNomPrenom = document.createElement("div");

    var pNomPrenom = document.createElement("p");
    pNomPrenom.textContent = "de " + message.nom + " " + message.prenom;

    var divMail = document.createElement("div");

    var pMail = document.createElement("p");
    pMail.textContent = message.mail;

    var divObjet = document.createElement("div");

    var pObjet = document.createElement("p");
    pObjet.textContent = message.objet;

    var divText = document.createElement("div");

    var pText = document.createElement("p");
    pText.textContent = message.text;

    var divBtn = document.createElement("div");

    var btn = document.createElement("button");
    btn.id = "btn" + message.id;
    btn.classList.add("btn");
    btn.classList.add("btn-danger");
    btn.textContent = message.btn;
    btn.addEventListener("click", function () {
        var btnSuppr = document.getElementById(this.id);
        btnSuppr.parentNode.parentNode.parentNode.removeChild(btnSuppr.parentNode.parentNode);
    });

    messages.appendChild(div);
    div.appendChild(divNomPrenom);
    divNomPrenom.appendChild(pNomPrenom);
    div.appendChild(divMail);
    divMail.appendChild(pMail);
    div.appendChild(divObjet);
    divObjet.appendChild(pObjet);
    div.appendChild(divText);
    divText.appendChild(pText);
    div.appendChild(divBtn);
    divBtn.appendChild(btn);
}

function addPortfolios() {
    // Récupération des portfolios de l'utilisateur
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
                console.log(listPortfolios);
                addPortfolio(p, (listPortfolios.indexOf(p)));
            }
            console.log(listPortfolios.length);
        }
    });
}

function addMessages() {
    // Récupération des messages de l'utilisateur
    $.ajax({
        type:"POST",
        url:"./function.php",
        data:"action=getMessages",
        complete: function(data) {
            var json = JSON.parse(data.responseText);

            for (var i=0; i<json.length; i++) {
                listMessages.push(new Message(json[i].nomutilisateur, 
                                            json[i].nomenvoyeur, 
                                            json[i].prenom,
                                            json[i].objet,
                                            json[i].mail,
                                            json[i].message));
            }

            // Ajout des messages
            for (var m of listMessages) {
                addMessage(m);
            }
        }
    });
}
function init() {
    var btn = document.getElementById("btnMail");
    btn.addEventListener("click", clickBtnMail, false);

    var btnCloseSideBar = document.getElementById("btnCloseSideBar");
    btnCloseSideBar.addEventListener("click", () => {
        document.getElementById("sidebar").style.transform = "translateX(-240px)";
    }, false)

    var search = document.getElementById("search-bar");
    search.addEventListener("input", searchPortfolio, false);

    addMessages();

    addPortfolios();
}

window.onload = init;