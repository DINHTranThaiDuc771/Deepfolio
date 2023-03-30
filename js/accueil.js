var isClicked = false;

function Message(nom, prenom, mail, objet, text) {
    this.nom = nom;
    this.prenom = prenom;
    this.mail = mail;
    this.object = objet;
    this.text = text;
    this.btn = "Supprimer";
}

var listMessages = [new Message("FERRAND", "Enzo", "enzo@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("LE MEUR", "Pierre", "pierre@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("BOUVET", "Eliott", "eliott@gmail.com", "Bonjour", "Je suis un message"),
                    new Message("DINH", "Duc", "duc@gmail.com", "Bonjour", "Je suis un message")];


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

function init()
{
    var btn = document.getElementById("btnMail");
    btn.addEventListener("click",clickBtnMail,false);

    for (var i = 0; i < 3; i++) {
        var messages = document.getElementById("messages");
        var div = document.createElement("div");
        div.setAttribute("class", "bloc-message");

        var message = listMessages[i];

        div.innerHTML = "<p>de "+ message.nom + " " + message.prenom + "</p>\n<p>à " + message.mail + "</p>\n<p>Objet : " + message.object + "</p>\n<p>" + message.text + "</p>\n<button type=\"button\" class=\"btn btn-danger\">" + message.btn + "</button>";
        messages.appendChild(div);
    }

    for (var i = 0; i < 6; i++){
        var portfolios = document.getElementById("portfolios");
        var portfolio  = listPortfolios[i];

        if (i % 3 == 0)
        {
            var div0 = document.createElement("div");
            div0.classList.add("row");
            div0.classList.add("my-5");
        }

        var div1 = document.createElement("div");
        div1.classList.add("col-md");

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
}

window.onload = init;