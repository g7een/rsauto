let lastScrollY = window.scrollY;

function headerScroll(){
    const cScrollY = window.scrollY;
    if((cScrollY > 50)){
        document.body.classList.add("scrolled");
    }
    else{
        document.body.classList.remove("scrolled");
    }
    lastScrollY = cScrollY;
}

window.addEventListener("scroll", headerScroll);

