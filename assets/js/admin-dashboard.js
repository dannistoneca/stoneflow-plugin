document.addEventListener("DOMContentLoaded", function () {
    const statusDropdowns = document.querySelectorAll(".order-status-dropdown");
    statusDropdowns.forEach(dropdown => {
        dropdown.addEventListener("change", function () {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;

            fetch(stoneflow_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    action: "update_order_status",
                    order_id: orderId,
                    new_status: newStatus,
                    nonce: stoneflow_ajax.nonce,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Order status updated successfully.");
                    } else {
                        alert("Error: " + data.data.message);
                    }
                })
                .catch(error => {
                    console.error("AJAX error:", error);
                });
        });
    });

    const priorityCheckboxes = document.querySelectorAll(".priority-toggle");
    priorityCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            const orderId = this.dataset.orderId;
            const isPriority = this.checked ? 1 : 0;

            fetch(stoneflow_ajax.ajax_url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    action: "update_order_priority",
                    order_id: orderId,
                    is_priority: isPriority,
                    nonce: stoneflow_ajax.nonce,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Priority updated successfully.");
                    } else {
                        alert("Error: " + data.data.message);
                    }
                })
                .catch(error => {
                    console.error("AJAX error:", error);
                });
        });
    });
});
