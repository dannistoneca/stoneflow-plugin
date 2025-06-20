// stoneflow-main.js

document.addEventListener("DOMContentLoaded", function () {
  const toggles = document.querySelectorAll(".sf-toggle");

  toggles.forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const targetId = this.dataset.target;
      const target = document.getElementById(targetId);
      if (target) {
        target.classList.toggle("hidden");
      }
    });
  });

  const statusForms = document.querySelectorAll(".sf-status-form");

  statusForms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(form);
      fetch(form.action, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            alert("Status updated!");
            location.reload();
          } else {
            alert("Something went wrong.");
          }
        });
    });
  });
});
