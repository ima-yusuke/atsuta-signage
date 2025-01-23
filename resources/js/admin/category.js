import '/resources/js/app.js';

document.querySelectorAll('#category-list > .categories').forEach(button => {
    button.addEventListener('click', () => {
        const icons = button.querySelectorAll('i');
        icons.forEach(icon => {
            icon.classList.toggle('hidden');
        });
        const details = button.nextElementSibling;
        details.classList.toggle('hidden');
        details.classList.toggle('flex');
    });
});
