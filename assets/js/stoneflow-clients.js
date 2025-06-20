document.addEventListener('DOMContentLoaded', function () {
    // Toggle service detail view
    document.querySelectorAll('.stoneflow-view-link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(`#details-${this.dataset.serviceId}`);
            if (target) {
                target.classList.toggle('hidden');
            }
        });
    });

    // Download file
    document.querySelectorAll('.stoneflow-download-link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.dataset.fileUrl;
            if (url) {
                window.open(url, '_blank');
            }
        });
    });

    // Submit client notes (if editable from client side)
    const noteForms = document.querySelectorAll('.stoneflow-client-note-form');
    noteForms.forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const serviceId = this.dataset.serviceId;
            const note = this.querySelector('textarea').value;

            fetch(stoneflow_ajax.ajax_url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=stoneflow_client_save_note&service_id=${serviceId}&note=${encodeURIComponent(note)}&_wpnonce=${stoneflow_ajax.nonce}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Note submitted!');
                } else {
                    alert('Failed to submit note.');
                }
            });
        });
    });
});
