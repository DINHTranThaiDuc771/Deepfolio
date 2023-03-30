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

function clickBtnMail()
{
    isClicked = !isClicked;


    if(isClicked)
    {
        document.getElementById("sidebar").style.width = "250px";
        document.getElementById("btnMail").style.marginLeft = "250px";
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
}

window.onload = init;