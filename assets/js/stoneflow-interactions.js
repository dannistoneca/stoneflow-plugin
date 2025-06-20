document.addEventListener("DOMContentLoaded", function () {
  const toggleButtons = document.querySelectorAll(".stoneflow-toggle");

  toggleButtons.forEach((btn) => {
    btn.addEventListener("click", function () {
      const target = document.getElementById(this.dataset.target);
      if (target) {
        target.classList.toggle("hidden");
      }
    });
  });

  const copyButtons = document.querySelectorAll(".copy-to-clipboard");
  copyButtons.forEach((btn) => {
    btn.addEventListener("click", function () {
      const text = this.dataset.copyText || this.textContent;
      navigator.clipboard.writeText(text).then(() => {
        this.textContent = "Copied!";
        setTimeout(() => (this.textContent = "Copy"), 1500);
      });
    });
  });
});
