document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".stoneflow-tab");
  const tabContents = document.querySelectorAll(".stoneflow-tab-content");

  tabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      const target = this.dataset.target;

      tabs.forEach((t) => t.classList.remove("active"));
      tabContents.forEach((content) => content.classList.remove("active"));

      this.classList.add("active");
      document.getElementById(target).classList.add("active");
    });
  });

  const viewLinks = document.querySelectorAll(".stoneflow-view-order");
  viewLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const href = this.getAttribute("href");
      window.location.href = href;
    });
  });
});
