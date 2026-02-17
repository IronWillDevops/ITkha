document.addEventListener('DOMContentLoaded', () => {
    const detailsElements = document.querySelectorAll('details[data-id]');

    detailsElements.forEach(detail => {
        const id = detail.getAttribute('data-id');
        const storageKey = 'details-' + id;

        // Восстановление состояния
        const isOpen = localStorage.getItem(storageKey);
        detail.open = isOpen === 'true';

        // Сохранение состояния
        detail.addEventListener('toggle', () => {
            localStorage.setItem(storageKey, detail.open);
        });
    });
});
