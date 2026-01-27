document.querySelectorAll('.tooltip-wrapper').forEach(el => {
    el.addEventListener('mouseenter', () => {
        el.classList.add('show');
    });

    el.addEventListener('mouseleave', () => {
        el.classList.remove('show');
    });
});