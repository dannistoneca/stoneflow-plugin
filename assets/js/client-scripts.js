// StoneFlow Client Dashboard Scripts

document.addEventListener('DOMContentLoaded', function () {
    const serviceRows = document.querySelectorAll('.stone-service-row');

    serviceRows.forEach(function (row) {
        row.addEventListener('click', function () {
            const serviceId = row.getAttribute('data-service-id');
            if (serviceId) {
                window.location.href = '?stoneflow_view_service=' + serviceId;
            }
        });
    });

    const notesForm = document.querySelector('.client-notes-form');
    if (notesForm) {
        notesForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const noteInput = this.querySelector('textarea');
            if (noteInput && noteInput.value.trim() !== '') {
                alert('Note submitted: ' + noteInput.value);
                noteInput.value = '';
            }
        });
    }
});
