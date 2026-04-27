let editpanel = document.getElementById("editbutton");
editpanel.addEventListener("click", () => {
    console.log("hi")
    document.querySelector(".edit-panel").classList.remove("hidden");
});

let collapse = document.getElementById("collapse");
collapse.addEventListener("click", () => {
    document.querySelector(".edit-panel").classList.add("hidden");
});