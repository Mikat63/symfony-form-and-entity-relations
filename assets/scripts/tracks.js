const TomSelect = window.TomSelect;

// btn's listener
const addTrackBtn = document.querySelector(".add-track-btn");
const editTrackBtn = document.querySelectorAll(".edit-track-btn");
const deleteTrackBtn = document.querySelectorAll(".delete-track-btn");
const submitBtn = document.querySelector(".submit-btn");

// This empty container is used as an anchor where JavaScript will inject the modal dialog received via AJAX.
const modalContainer = document.querySelector(".modal-container");

// listeners with button listened, route to controller and title for the dynamic modal
function btnListener(btn, route, title) {
    if (btn) {
        btn.addEventListener("click", () => {
            getForm(route, title);
        });
    }
}

btnListener(addTrackBtn, "/tracks/new", "Ajouter une track");

editTrackBtn.forEach((editBtn) => {
    btnListener(
        editBtn,
        `/tracks/edit/${editBtn.dataset.id}`,
        "Modifier une track",
    );
});

deleteTrackBtn.forEach((deleteBtn) => {
    btnListener(
        deleteBtn,
        `/tracks/delete/${deleteBtn.dataset.id}`,
        "Supprimer une track",
    );
});

// function to start fetch with route in param
function getForm(route, title) {
    fetch(route, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            showFormModal(data, title);
        });
}

// this function add the dialog form for add and edit track in template. Change the title of the form.
function showFormModal(data, title) {
    modalContainer.innerHTML = data.content;

    const FormModal = modalContainer.querySelector(".form-modal");
    const formTitleModal = FormModal.querySelector("#form-title-modal");
    formTitleModal.textContent = title;

    FormModal.showModal();
    document.body.style.overflow = "hidden";

    const cancelBtn = FormModal.querySelector(".cancel-btn");

    if (cancelBtn) {
        cancelBtn.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            FormModal.close();
            document.body.style.overflow = "";
            modalContainer.innerHTML = "";
        });
    }
}
