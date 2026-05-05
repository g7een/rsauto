let collapse = document.getElementById("collapse");
collapse.addEventListener("click", () => {
    document.querySelector(".edit-panel").classList.add("hidden");
});

const dropZone = document.getElementById("dropZone");
const fileInput = document.getElementById("fileInput");
const imageQueue = document.getElementById("imageQueue");
const imageQueueEmpty = document.getElementById("imageQueueEmpty");
const addMoreImages = document.getElementById("addMoreImages");
const addListingForm = document.getElementById("addListingForm");
let selectedImages = [];
let draggedImageIndex = null;

dropZone.addEventListener("click", () => fileInput.click());
addMoreImages.addEventListener("click", () => fileInput.click());

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

    addFiles(e.dataTransfer.files);
});

fileInput.addEventListener("change", () => {
    addFiles(fileInput.files);
});

addListingForm.addEventListener("submit", (e) => {
    syncFileInput();

    if (selectedImages.length === 0) {
        e.preventDefault();
        imageQueueEmpty.textContent = "Please add at least one image.";
        imageQueueEmpty.classList.add("error");
    }
});

document.querySelectorAll(".edit").forEach(btn => {
    btn.addEventListener("click", () => {
        document.querySelector(".edit-panel").classList.remove("hidden");

        document.getElementById("edit-id").value = btn.dataset.id;
        document.getElementById("edit-title").value = btn.dataset.title;
        document.getElementById("edit-price").value = btn.dataset.price;
        document.getElementById("edit-description").value = btn.dataset.description;

        loadImages(btn.dataset.id);
    });
});

function addFiles(files) {
    const imageFiles = Array.from(files).filter(file => file.type.startsWith("image/"));

    imageFiles.forEach(file => {
        selectedImages.push({
            file,
            previewUrl: URL.createObjectURL(file)
        });
    });

    renderImageQueue();
    syncFileInput();
}

function renderImageQueue() {
    imageQueue.innerHTML = "";
    imageQueueEmpty.classList.toggle("hidden", selectedImages.length > 0);
    imageQueueEmpty.classList.remove("error");
    imageQueueEmpty.textContent = "No images selected yet.";

    dropZone.innerHTML = `
        <i class="fa-regular fa-file-image"></i>
        <p>${selectedImages.length ? `${selectedImages.length} image${selectedImages.length === 1 ? "" : "s"} selected` : "Drop or select images"}</p>
    `;

    selectedImages.forEach((image, index) => {
        const row = document.createElement("div");
        row.className = "image-queue-item";
        row.draggable = true;
        row.dataset.index = index;
        row.innerHTML = `
            <span class="image-drag-handle" title="Drag to reorder">
                <i class="fa-solid fa-grip-vertical"></i>
            </span>
            <img src="${image.previewUrl}" alt="">
            <div class="image-queue-details">
                <p>${escapeHtml(image.file.name)}</p>
                <span>Image ${index + 1}</span>
            </div>
            <div class="image-queue-actions">
                <button type="button" data-action="remove" data-index="${index}" title="Remove image">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        `;

        imageQueue.appendChild(row);
    });
}

imageQueue.addEventListener("click", (e) => {
    const button = e.target.closest("button");
    if (!button) {
        return;
    }

    const index = Number(button.dataset.index);
    const action = button.dataset.action;

    if (action === "remove") {
        URL.revokeObjectURL(selectedImages[index].previewUrl);
        selectedImages.splice(index, 1);
    }

    if (action === "up" && index > 0) {
        [selectedImages[index - 1], selectedImages[index]] = [selectedImages[index], selectedImages[index - 1]];
    }

    if (action === "down" && index < selectedImages.length - 1) {
        [selectedImages[index + 1], selectedImages[index]] = [selectedImages[index], selectedImages[index + 1]];
    }

    renderImageQueue();
    syncFileInput();
});

imageQueue.addEventListener("dragstart", (e) => {
    const item = e.target.closest(".image-queue-item");
    if (!item) {
        return;
    }

    draggedImageIndex = Number(item.dataset.index);
    item.classList.add("dragging");
});

imageQueue.addEventListener("dragover", (e) => {
    e.preventDefault();
});

imageQueue.addEventListener("drop", (e) => {
    e.preventDefault();
    const item = e.target.closest(".image-queue-item");

    if (!item || draggedImageIndex === null) {
        return;
    }

    const targetIndex = Number(item.dataset.index);
    const [movedImage] = selectedImages.splice(draggedImageIndex, 1);
    selectedImages.splice(targetIndex, 0, movedImage);
    draggedImageIndex = null;

    renderImageQueue();
    syncFileInput();
});

imageQueue.addEventListener("dragend", () => {
    draggedImageIndex = null;
    document.querySelectorAll(".image-queue-item.dragging").forEach(item => {
        item.classList.remove("dragging");
    });
});

function syncFileInput() {
    const dataTransfer = new DataTransfer();

    selectedImages.forEach(image => {
        dataTransfer.items.add(image.file);
    });

    fileInput.files = dataTransfer.files;
}

function escapeHtml(value) {
    const div = document.createElement("div");
    div.textContent = value;
    return div.innerHTML;
}

function loadImages(listingId) {
    fetch(`get_images.php?id=${listingId}`)
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById("imageManager");
        container.innerHTML = "";

        data.forEach(img => {
            container.innerHTML += `
                <div class="img-row" data-id="${img.id}">
                    <img src="${img.image_url}" width="80">
                    <button onclick="deleteImage(${img.id})">Delete</button>
                </div>
            `;
        });
    })
    .catch(() => {
        document.getElementById("imageManager").innerHTML = "<p class=\"image-manager-note\">Image manager is unavailable.</p>";
    });
}

window.deleteImage = function deleteImage(id) {
    const formData = new FormData();
    formData.append("id", id);

    fetch("delete_image.php", {
        method: "POST",
        body: formData
    }).then(() => {
        const row = document.querySelector(`.img-row[data-id="${id}"]`);
        if (row) {
            row.remove();
        }
    });
};
