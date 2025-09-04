// Tasks page functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Tasks page initialized');

    // Auto-submit form when filter/sort values change (only on index page)
    const statusSelect = document.getElementById('status');
    const orderBySelect = document.getElementById('order_by');
    const orderDirectionSelect = document.getElementById('order_direction');

    function autoSubmitForm() {
        const form = statusSelect.closest('form');
        // Only auto-submit if it's a GET form (filter form), not POST form (create/edit form)
        if (form && form.method.toLowerCase() === 'get') {
            form.submit();
        }
    }

    // Add change event listeners for auto-filtering (only for filter forms)
    if (statusSelect && orderBySelect && orderDirectionSelect) {
        // This ensures we're on the index page with all filter elements
        statusSelect.addEventListener('change', autoSubmitForm);
        orderBySelect.addEventListener('change', autoSubmitForm);
        orderDirectionSelect.addEventListener('change', autoSubmitForm);
    }

    // Confirm delete action
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                e.preventDefault();
            }
        });
    });

    // Highlight overdue tasks
    const overdueTasks = document.querySelectorAll('tr[data-overdue="true"]');
    overdueTasks.forEach(row => {
        row.classList.add('bg-red-50', 'dark:bg-red-950/30');
    });

    // Add animation to success message
    const successMessage = document.querySelector('.success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => {
                successMessage.remove();
            }, 300);
        }, 5000);
    }
});
