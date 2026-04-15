let signin = document.getElementById("signin");
signin.addEventListener("click", () =>{
    console.log("clicked");
    document.querySelector(".admin-panel").classList.remove("hidden");
    document.querySelector(".login-panel").classList.add("hidden");
});


