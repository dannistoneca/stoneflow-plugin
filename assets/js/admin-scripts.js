document.addEventListener("DOMContentLoaded", function () {
    const statusSelectors = document.querySelectorAll(".stone-status-select");

    statusSelectors.forEach(function (select) {
        select.addEventListener("change", function () {
            const serviceId = this.dataset.serviceId;
            const newStatus = this.value;

            fetch(stoneflow_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=stoneflow_update_service_status&service_id=${serviceId}&new_status=${newStatus}&_wpnonce=${stoneflow_ajax.nonce}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Status updated successfully!");
                        location.reload();
                    } else {
                        alert("Failed to update status.");
                    }
                })
                .catch((error) => {
                    console.error("Error updating status:", error);
                    alert("An error occurred while updating status.");
                });
        });
    });

    const priorityToggles = document.querySelectorAll(".stone-priority-toggle");

    priorityToggles.forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            const serviceId = this.dataset.serviceId;

            fetch(stoneflow_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `action=stoneflow_toggle_priority&service_id=${serviceId}&_wpnonce=${stoneflow_ajax.nonce}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Priority toggled successfully!");
                        location.reload();
                    } else {
                        alert("Failed to toggle priority.");
                    }
                })
                .catch((error) => {
                    console.error("Error toggling priority:", error);
                    alert("An error occurred while toggling priority.");
                });
        });
    });
});
