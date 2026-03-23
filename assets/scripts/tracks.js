const TomSelect = window.TomSelect;

// btn's listener
const addTrackBtn = document.querySelector(".add-track-btn");
const editTrackBtn = document.querySelectorAll(".edit-track-btn");
const deleteTrackBtn = document.querySelectorAll(".delete-track-btn");

// This empty container is used as an anchor where JavaScript will inject the modal dialog received via AJAX.
const modalContainer = document.querySelector(".modal-container");

// listeners with button listened, route to controller and title for the dynamic modal
function btnListener(btn, fn, route, title) {
    if (btn) {
        btn.addEventListener("click", () => {
            fn(route, title);
        });
    }
}

// functions to fetch with route in param
function getForm(route, title) {
    fetch(route, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            showFormModal(data, title);
        });
}

// Listeners
btnListener(addTrackBtn, getForm, "/tracks/new", "Ajouter une track");

editTrackBtn.forEach((editBtn) => {
    btnListener(
        editBtn,
        getForm,
        `/tracks/edit/${editBtn.dataset.id}`,
        "Modifier une track",
    );
});

deleteTrackBtn.forEach((deleteBtn) => {
    btnListener(
        deleteBtn,
        getForm,
        `/tracks/delete/${deleteBtn.dataset.id}`,
        "Supprimer une track",
    );
});


function postForm(route, form) {
    const formData = new FormData(form);

    fetch(route, {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("ok");
        });
}

// this function add the dialog form for add and edit track in template. Change the title of the form.
function showFormModal(data, title) {
    console.log(data);

    modalContainer.innerHTML = data.content;

    const formModal = modalContainer.querySelector(".form-modal");
    const formTitleModal = formModal.querySelector("#form-title-modal");
    formTitleModal.textContent = title;

    formModal.showModal();
    document.body.style.overflow = "hidden";

    const cancelBtn = formModal.querySelector(".cancel-btn");

    if (cancelBtn) {
        cancelBtn.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();

            formModal.close();
            document.body.style.overflow = "";
            modalContainer.innerHTML = "";
        });
    }

    // for create and edit form
    const form = formModal.querySelector("form");

    if (form) {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            postForm(form.action, form);
        });
    }

    // for delete
    const confirmDeletetBtn = formModal.querySelector(".confirm-delete-btn");

    if (confirmDeletetBtn) {
        confirmDeletetBtn.addEventListener("click", () => {
            fetch(confirmDeletetBtn.dataset.route, {
                method: "POST",
            }).then((response) => response.json());
        });
    }
}
