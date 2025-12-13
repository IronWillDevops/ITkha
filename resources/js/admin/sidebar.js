document.addEventListener('DOMContentLoaded', () => {
    const detailsElements = document.querySelectorAll('aside details[data-id]');

    detailsElements.forEach(detail => {
        const id = detail.getAttribute('data-id');
        const isOpen = localStorage.getItem('sidebar-' + id);

        // Восстановление состояния
        if (isOpen === 'true') {
            detail.setAttribute('open', '');
        } else {
            detail.removeAttribute('open');
        }

        // Сохранение состояния при раскрытии/сворачивании
        detail.addEventListener('toggle', () => {
            localStorage.setItem('sidebar-' + id, detail.open);
        });
    });
});
