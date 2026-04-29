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


const hamburger = document.getElementById("hamburger");
const sideMenu = document.getElementById("sideMenu");

hamburger.addEventListener("click", () => {
    sideMenu.classList.toggle("active");
});

document.addEventListener("click", (e) => {
    if (!sideMenu.contains(e.target) && !hamburger.contains(e.target)) {
        sideMenu.classList.remove("active");
    }
});

document.querySelectorAll(".side-title").forEach(title => {
    title.addEventListener("click", () => {
        const parent = title.parentElement;
        parent.classList.toggle("active");
    });
});

const listingsSearch = document.querySelector(".listings-search-wrapper input");
const listingsGrid = document.querySelector(".listings-grid");

listingsSearch.addEventListener("input", function () {
    let query = this.value;

    fetch("search_listings.php?q=" + encodeURIComponent(query))
        .then(res => res.json())
        .then(data => {
            listingsGrid.innerHTML = "";

            if (data.length === 0) {
                listingsGrid.innerHTML = "<p>No listings found.</p>";
                return;
            }

            data.forEach(item => {
                let card = document.createElement("div");
                card.classList.add("listing-card");

                card.innerHTML = `
                    <img src="${item.image_url}" alt="Listing image">
                    <h3>${item.title}</h3>
                    <p>$${item.price}</p>
                    <p>${item.description}</p>
                `;

                listingsGrid.appendChild(card);
            });
        });
});