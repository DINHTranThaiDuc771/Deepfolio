

var slides = ['img/draw2.svg','img/portfolio.jpeg','img/draw2.svg','img/portfolio.jpeg','img/draw2.svg','img/portfolio.jpeg','img/draw2.svg',]; 

var Start=0;

function slider(){
    var img = document.getElementById('img');
    if(Start<slides.length){
        Start=Start+1;
    }
    else{
        Start=1;
    }
    console.log(img);
    img.innerHTML = "<img src="+slides[Start-1]+">";
   
}
setInterval(slider,2000);



