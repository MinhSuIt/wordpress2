function showToast(message, type = 'info', duration = 5000) {
    const container = document.getElementById('toastContainer');

    const toast = document.createElement('div');
    toast.className = `custom-toast ${type}`;
    toast.innerHTML = `
            <span>${message}</span>
            <button>&times;</button>
        `;

    // Close button
    toast.querySelector('button').onclick = () => {
        toast.remove();
    };

    container.appendChild(toast);

    // Auto remove
    setTimeout(() => {
        toast.remove();
    }, duration);
}