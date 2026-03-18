// btn's listener
const addTrackBtn = document.querySelector(".add-track-btn");
const editTrackBtn = document.querySelectorAll(".edit-track-btn");
const deleteTrackBtn = document.querySelectorAll(".delete-track-btn");
const submitBtn = document.querySelector(".submit-btn");

// This empty container is used as an anchor where JavaScript will inject the modal dialog received via AJAX.
const modalContainer = document.querySelector(".modal-container");

// listeners
function btnListener(btn, route) {
    if (btn) {
        btn.addEventListener("click", () => {
            getForm(route);
        });
    }
}

btnListener(addTrackBtn, "/tracks/new");

editTrackBtn.forEach((editBtn) => {
    btnListener(editBtn, `/tracks/edit/${editBtn.dataset.id}`);
});

// function to start fetch with route in param
function getForm(route) {
    fetch(route, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            showFormModal(data, "Ajouter une Track");
        });
}

// this function add the dialog form for add and edit track in template. Change the title of the form.
function showFormModal(data, titleModal) {
    modalContainer.innerHTML = data.content;

    const FormModal = modalContainer.querySelector(".form-modal");
    const formTitleModal = FormModal.querySelector("#form-title-modal");
    formTitleModal.textContent = titleModal;

    FormModal.showModal();

    const cancelBtn = FormModal.querySelector(".cancel-btn");

    if (cancelBtn) {
        cancelBtn.addEventListener("click", (event) => {
            console.log("test annuler");

            event.preventDefault();
            event.stopPropagation();

            FormModal.close();
            modalContainer.innerHTML = "";
        });
    }
}
