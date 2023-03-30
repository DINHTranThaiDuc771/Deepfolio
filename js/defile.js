var slides = ['../img/draw2.svg','../img/portfolio.jpeg','../img/portfolio2.jpeg']; 

var start=0;

setInterval(nextSlide,4000);

function nextSlide(){   
    var divImg = document.getElementById('divImg');
    
    start = (start+1)%slides.length;

    var img = document.getElementById('img');
    img.setAttribute('src',slides[start]);
    img.setAttribute('class','img-fluid');
}

function previousSlide(){
    var divImg = document.getElementById('divImg');

    if(start == 0){
        start = slides.length-1;
    }else{
        start--;
    }

    var img = document.getElementById('img');
    img.setAttribute('src',slides[start]);
    img.setAttribute('class','img-fluid');
}




window.onload = function(){
    document.getElementById('next').addEventListener('click',nextSlide);
    document.getElementById('previous').addEventListener('click',previousSlide);

    // Example starter JavaScript for disabling form submissions if there are invalid fields
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