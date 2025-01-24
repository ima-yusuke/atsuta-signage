import '/resources/js/app.js';

document.querySelectorAll('.video-contents').forEach(button => {
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

document.addEventListener("DOMContentLoaded", () => {
    const categoryItems = document.querySelectorAll(".category-item");
    const newContent = document.getElementById('new-content');

    categoryItems.forEach((item) => {
        item.addEventListener("click", () => {
            // data-category-id属性からカテゴリーIDを取得
            const categoryId = item.getAttribute("data-category-id");
            document.querySelectorAll('.video-contents').forEach(button => {
                const contentCategoryId = button.getAttribute('data-content-category-id');
                const contentDetails = button.nextElementSibling;
                const show = document.querySelectorAll('.bi-chevron-down');
                const none = document.querySelectorAll('.bi-chevron-up');
                button.classList.remove('flex');
                button.classList.add('hidden');
                button.classList.add('mb-2');
                contentDetails.classList.add('hidden');
                contentDetails.classList.remove('mb-2');
                show.forEach(icon => {
                    icon.classList.remove('hidden');
                });
                none.forEach(icon => {
                    icon.classList.add('hidden');
                });
                if (categoryId === contentCategoryId) {
                    button.classList.remove('hidden');
                    button.classList.add('flex');
                }
            });
            newContent.classList.add('hidden');
            if (categoryId === '0') {
                newContent.classList.remove('hidden');
            }
        });
    });
});
