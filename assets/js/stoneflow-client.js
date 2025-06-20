document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-order-btn');

    viewButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const orderId = button.dataset.orderId;
            const detailRow = document.getElementById('details-' + orderId);
            if (detailRow) {
                detailRow.classList.toggle('visible');
            }
        });
    });

    const noteForms = document.querySelectorAll('.client-note-form');

    noteForms.forEach((form) => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            const submitButton = form.querySelector('button');
            submitButton.disabled = true;
            submitButton.textContent = 'Saving...';

            fetch(form.action, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Save Note';
                    alert(data.message || 'Note saved successfully!');
                })
                .catch((error) => {
                    console.error('Error:', error);
                    submitButton.disabled = false;
                    submitButton.textContent = 'Save Note';
                    alert('An error occurred while saving the note.');
                });
        });
    });
});
