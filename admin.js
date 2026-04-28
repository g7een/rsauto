document.querySelectorAll(".edit").forEach(btn => {
    btn.addEventListener("click", () => {
        document.querySelector(".edit-panel").classList.remove("hidden");
    });
});

let collapse = document.getElementById("collapse");
collapse.addEventListener("click", () => {
    document.querySelector(".edit-panel").classList.add("hidden");
});

const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("fileInput");

dropZone.addEventListener("click", () => fileInput.click());

dropZone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZone.classList.add("dragover");
});

dropZone.addEventListener("dragleave", () => {
    dropZone.classList.remove("dragover");
});

dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("dragover");

    const file = e.dataTransfer.files[0];
    fileInput.files = e.dataTransfer.files;

    dropZone.innerHTML = `<p>${file.name}</p>`;
});

fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (file) {
        dropZone.innerHTML = `<p>${file.name}</p>`;
    }
});