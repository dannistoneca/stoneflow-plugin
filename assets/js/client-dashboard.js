document.addEventListener("DOMContentLoaded", function () {
    const serviceTabs = document.querySelectorAll(".service-tab");
    const serviceContents = document.querySelectorAll(".service-content");

    serviceTabs.forEach((tab) => {
        tab.addEventListener("click", function () {
            const target = this.dataset.target;

            serviceTabs.forEach((t) => t.classList.remove("active"));
            this.classList.add("active");

            serviceContents.forEach((content) => {
                content.style.display = "none";
            });

            const targetContent = document.querySelector(`#${target}`);
            if (targetContent) {
                targetContent.style.display = "block";
            }
        });
    });

    const toggleNotesButtons = document.querySelectorAll(".toggle-notes-btn");
    toggleNotesButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const notesId = this.dataset.notesId;
            const notesSection = document.querySelector(`#notes-${notesId}`);
            if (notesSection) {
                notesSection.classList.toggle("hidden");
            }
        });
    });

    const downloadButtons = document.querySelectorAll(".download-file-btn");
    downloadButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const fileUrl = this.dataset.fileUrl;
            if (fileUrl) {
                window.open(fileUrl, "_blank");
            }
        });
    });
});
