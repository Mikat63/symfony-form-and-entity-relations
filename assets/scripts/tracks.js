console.log("tracks.js loaded");
// btn's listener
const addTrackBtn = document.querySelector(".add-track-btn");
const editTrackBtn = document.querySelectorAll(".edit-track-btn");
const deleteTrackBtn = document.querySelectorAll(".delete-track-btn");

// This empty container is used as an anchor where JavaScript will inject the modal dialog received via AJAX.
const modalContainer = document.querySelector("#modal-container");

// listeners
if (addTrackBtn && FormModal) {
    addTrackBtn.addEventListener("click", () => {
        getForm("app_new_track");
    });
}

// function to start fetch with route in param
function getForm(route) {
    fetch(route, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            showFormModal(data);
        });
}

// this function add the dialog form for add and edit track in template. Change the title of the form.
function showFormModal(data, titleModal) {
    modalContainer.innerHTML = data.content;

    const FormModal = modalContainer.querySelector(".form-modal");
    const formTitleModal = modalContainer.querySelector("#form-title-modal");
    formTitleModal.textContent = titleModal;

    FormModal.showModal();
}
