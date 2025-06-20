// StoneFlow Admin JavaScript

document.addEventListener("DOMContentLoaded", function () {
    const statusDropdowns = document.querySelectorAll(".stoneflow-status-select");

    statusDropdowns.forEach(dropdown => {
        dropdown.addEventListener("change", function () {
            const serviceId = this.dataset.serviceId;
            const newStatus = this.value;

            fetch(stoneflow_admin_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `action=stoneflow_update_status&service_id=${serviceId}&new_status=${newStatus}&nonce=${stoneflow_admin_ajax.nonce}`
            })
            .then(res => res.json())
            .then(response => {
                if (response.success) {
                    alert("Status updated successfully!");
                    location.reload();
                } else {
                    alert("Failed to update status.");
                }
            })
            .catch(error => {
                console.error("Error updating status:", error);
                alert("An error occurred.");
            });
        });
    });
});
