const addTrackBtn = document.querySelector(".add-track-btn");
const editTrackBtn = document.querySelectorAll(".edit-track-btn");
const deleteTrackBtn = document.querySelectorAll(".delete-track-btn");
const FormModal = document.querySelector(".form-modal");
const formTitleModal = document.querySelector("#form-title-modal");

// function to start fetch with route in param
function crudTrack(route) {
    fetch(route, {
        method: "GET",
        headers: { "Content-Type": formData },
    })
        .then((response) => response.json())
        .then((data) => {
            showFormModal(data);
        });
}

if (addTrackBtn && FormModal) {
    addTrackBtn.addEventListener("click", () => {
        console.log("hello");

        FormModal.showModal();
    });
}

function showFormModal(data) {}
