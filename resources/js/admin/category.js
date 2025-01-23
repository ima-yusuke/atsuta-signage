import '/resources/js/app.js';

document.querySelectorAll('#category-list > .categories').forEach(button => {
    button.addEventListener('click', () => {
        const icons = button.querySelectorAll('i');
        icons.forEach(icon => {
            icon.classList.toggle('hidden');
        });
        button.classList.toggle('mb-2');
        const details = button.nextElementSibling;
        details.classList.toggle('mb-2')
        details.classList.toggle('hidden');
        details.classList.toggle('flex');
    });
});
