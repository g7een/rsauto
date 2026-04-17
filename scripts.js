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


const searchBox = document.querySelector(".search");
const overlay = document.getElementById("searchOverlay");
const closeBtn = document.getElementById("closeSearch");

searchBox.addEventListener("click", () => {
    overlay.classList.add("active");
});

closeBtn.addEventListener("click", () => {
    overlay.classList.remove("active");
});

overlay.addEventListener("click", (e) => {
    if (e.target===overlay) {
        overlay.classList.remove("active");
    }
});

const overlayInput = document.querySelector(".search-overlay-input");
const suggestionsBox = document.querySelector(".suggest-items");

overlayInput.addEventListener("input", function () {
    let query = this.value;

    if (query.length < 1) {
        suggestionsBox.innerHTML = "";
        return;
    }

    fetch("search.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            suggestionsBox.innerHTML = "";

            data.forEach(item => {
                let div = document.createElement("span");
                div.textContent = item.title;

                div.addEventListener("click", () => {
                    overlayInput.value = item.title;
                });

                suggestionsBox.appendChild(div);
            });
        });
});

