// OPEN MODAL BY ID
document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-modal-target]');
    if (!btn) return;

    const modalId = btn.getAttribute('data-modal-target');
    const modal = document.getElementById(modalId);

    if (modal) {
        modal.classList.add('active');
    }
});

// CLOSE MODAL
document.addEventListener('click', function (e) {
    if (
        e.target.classList.contains('custom-modal') ||
        e.target.hasAttribute('data-close')
    ) {
        const modal = e.target.closest('.custom-modal');
        if (modal) {
            modal.classList.remove('active');
        }
    }
});

// ESC KEY
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document
            .querySelectorAll('.custom-modal.active')
            .forEach(m => m.classList.remove('active'));
    }
});