let lastScrollY = window.scrollY;

function headerScroll(){
    const cScrollY = window.scrollY;

    if((cScrollY > 50 && cScrollY > lastScrollY)){
        document.body.classList.add("scrolled");
    }
    else{
        document.body.classList.remove("scrolled");
    }

    lastScrollY = cScrollY;
}

window.addEventListener("scroll", headerScroll);

