import "./bootstrap";
import "~resources/scss/app.scss";
import * as bootstrap from "bootstrap";
import Chart from "chart.js/auto";
import.meta.glob(["../img/**", "../fonts/**"]);

const buttons = document.querySelectorAll(".cancel-button");
buttons.forEach((button) => {
    button.addEventListener("click", (event) => {
        event.preventDefault();
        const dataTitle = button.getAttribute("data-item-title");
        const modal = document.getElementById("deleteModal");

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();
        const title = document.getElementById("modal-item-title");
        title.textContent = dataTitle;
        const buttonDelete = modal.querySelector("button.btn-primary");
        buttonDelete.addEventListener("click", (event) => {
            button.parentElement.submit();
        });
    });
});

const previewImage = document.getElementById("image");
previewImage.addEventListener("change", (event) => {
    const ofReader = new FileReader();
    ofReader.readAsDataURL(previewImage.files[0]);

    ofReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
});

const ctx = document.getElementById("myChart");
new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
            {
                label: "# of Votes",
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1,
            },
        ],
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
