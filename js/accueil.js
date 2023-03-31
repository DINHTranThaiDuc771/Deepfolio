var isClicked = false;

function Message(id, nom, prenom, mail, objet, text) {
    this.id = id;
    this.nom = nom;
    this.prenom = prenom;
    this.mail = mail;
    this.objet = objet;
    this.text = text;
    this.btn = "Supprimer";
}

var listMessages = [new Message("1", "FERRAND", "Enzo", "enzo@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("2", "LE MEUR", "Pierre", "pierre@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("3", "BOUVET", "Eliott", "eliott@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("4", "DINH", "Duc", "duc@gmail.com", "Bonjour", "Je suis un message")];


function Portfolio(nomUtilisateur, idPortfolio, nom, accessible) {
    this.nomUtilisateur = nomUtilisateur;
    this.idPortfolio = idPortfolio;
    this.nom = nom;
    this.accessible = accessible;
}

var listPortfolios = [new Portfolio("FERRAND", "1", "Portfolio S2", true),
                      new Portfolio("FERRAND", "2", "Portfolio League of Legends", true),
                      new Portfolio("FERRAND", "3", "Portfolio Le Havre", true),
                      new Portfolio("FERRAND", "4", "Portfolio IUT", true),
                      new Portfolio("FERRAND", "5", "Portfolio PLP", true),
                      new Portfolio("FERRAND", "6", "Portfolio Duc", true)];

function clickBtnMail()
{
    isClicked = !isClicked;


    if(isClicked)
    {
        document.getElementById("sidebar").style.width = "15vw";
        document.getElementById("btnMail").style.marginLeft = "15vw";
    }
    else
    {
        document.getElementById("sidebar").style.width = "0";
        document.getElementById("btnMail").style.marginLeft= "0";
    }

}

function searchPortfolio()
{
    var container = document.getElementById("portfolios");

    while (container.firstChild)
    {
        container.removeChild(container.lastChild);
    }

    var search = document.getElementById("search-bar").value.toUpperCase();

    if (search != "")
    {
        var cpt = 0;
        for(var p of listPortfolios)
        {
            if(p.nom.toUpperCase().includes(search))
            {
                addPortfolio(p, cpt);
                cpt++;
            } 
        }
    }
    else
    {
        for(var p of listPortfolios)
        {
            addPortfolio(p, listPortfolios.indexOf(p));
        }
    }
}

function addPortfolio(p, i)
{
    var portfolios = document.getElementById("portfolios");
    var portfolio  = p;

    var div0;
    var id = parseInt((i/3 + 1));

    if (i % 3 == 0)
    {
        div0 = document.createElement("div");
        div0.id = "rowPortfolio" + id;
        div0.classList.add("row");
        div0.classList.add("my-5");
    }
    else
    {
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
    img.setAttribute("src", "https://mdbcdn.b-cdn.net/img/new/standard/nature/11"+(i+4)+".webp");

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

function init()
{
    var btn = document.getElementById("btnMail");
    btn.addEventListener("click",clickBtnMail,false);

    var search = document.getElementById("search-bar");
    search.addEventListener("input", searchPortfolio, false);

    for (var i = 0; i < 3; i++) { // Création des messages
        var messages = document.getElementById("messages");
        var message = listMessages[i];

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
                btn.addEventListener("click", function() {
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

    for (var p of listPortfolios){ // Création des portfolios
        addPortfolio(p, listPortfolios.indexOf(p));
    }
}

window.onload = init;