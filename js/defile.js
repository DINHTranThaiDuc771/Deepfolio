var slides = ['../img/image.png', '../img/image1.jpg']; 

var index=0;

var interval;

var tabImages = new Array();


function nextSlide(){   
    var divImg = document.getElementById('divImg');
    
    var ancien = index;
    index = (index+1)%slides.length;

    changeImage(ancien);

}

function changeImage(ancien){

    var imgActuelle = tabImages[index];
    var imgAncienne = tabImages[ancien];

    imgAncienne.style.display = "none";
    imgActuelle.style.display = "block";    
}

function previousSlide(){
    var divImg = document.getElementById('divImg');

    var ancien = index;
    if(index == 0){
        index = slides.length-1;
    }else{
        index--;
    }

    changeImage(ancien);    
}

function stopChangement() {
    clearInterval(interval);
}

function lancerChangement() {
    interval = setInterval(nextSlide,4000);
}

function displayAlert(){
    alert("Mauvais mot de passe ou nom d'utilisateur");
}




window.onload = function(){
    var btnNext = document.getElementById('next');
    var btnPrev = document.getElementById('previous');

    btnNext.addEventListener('click',nextSlide);
    btnPrev.addEventListener('click',previousSlide);

    var div = document.getElementById('next').parentElement;
    div.style.overflow = "hidden";

    div.removeChild(btnNext);
    

    for ( var s of slides )
    {
        var img = document.createElement("img");
        
        img.setAttribute("src", s);
        img.setAttribute('class','img-fluid');
        img.setAttribute('width', '95%');
        
        img.style.transition = "2s"; 
        img.style.display = "none";


        img.addEventListener("mouseover", stopChangement);
        img.addEventListener("mouseleave", lancerChangement);
        
        tabImages[tabImages.length] = img;  

        div.appendChild(img);
    }

    div.appendChild(btnNext);

    nextSlide();

    interval = setInterval(nextSlide,4000);



    // Example indexer JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');
        console.log(forms);

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
        form.addEventListener('submit', (event) => {
            
            if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
        });
    })();
}