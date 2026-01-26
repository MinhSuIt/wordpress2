document.querySelectorAll('.custom-collapse').forEach(collapse => {
    const content = collapse.querySelector('.collapse-content');

    // Initial state
    if (!collapse.open) {
        content.style.height = 0;
    }

    content.style.transition = 'height .3s ease';

    collapse.addEventListener('toggle', () => {
        if (collapse.open) {
            const height = content.scrollHeight;
            content.style.height = height + 'px';

            content.addEventListener('transitionend', function handler() {
                content.style.height = 'auto';
                content.removeEventListener('transitionend', handler);
            });
        } else {
            const height = content.scrollHeight;
            content.style.height = height + 'px';

            requestAnimationFrame(() => {
                content.style.height = 0;
            });
        }
    });
});