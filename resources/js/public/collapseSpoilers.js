document.addEventListener('DOMContentLoaded', () => {
    document
        .querySelectorAll('details.wysiwyg-spoiler[open]')
        .forEach(spoiler => {
            spoiler.removeAttribute('open');
        });
});