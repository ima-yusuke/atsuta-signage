import '/resources/js/app.js';

document.addEventListener('DOMContentLoaded', () => {
    // アコーディオンの切り替え
    document.querySelectorAll('#category-list > .categories').forEach(button => {
        button.addEventListener('click', () => {
            const icons = button.querySelectorAll('i');
            icons.forEach(icon => {
                icon.classList.toggle('hidden');
            });
            button.classList.toggle('mb-2');
            const details = button.nextElementSibling;
            details.classList.toggle('mb-2');
            details.classList.toggle('hidden');
            details.classList.toggle('flex');
        });
    });

    // 閉じるボタンのクリックイベント
    document.querySelectorAll('.close-button').forEach(button => {
        button.addEventListener('click', () => {
            const alertArea = button.closest('.alert-area');
            alertArea.remove();
        });
    });

    // エラー時に該当アコーディオンを開く処理
    const errorAccordions = document.querySelectorAll('.has-error');
    if (errorAccordions.length > 0) {
        errorAccordions.forEach(accordion => {
            const button = accordion.previousElementSibling;
            if (button) {
                const icons = button.querySelectorAll('i');
                icons.forEach(icon => icon.classList.toggle('hidden'));
                button.classList.toggle('mb-2');
            }
            accordion.classList.toggle('hidden');
            accordion.classList.toggle('flex');

            // 最初のエラー箇所にスクロール移動
            accordion.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    }

    const errorNewContent = document.getElementById('error-new-category');
    if (errorNewContent) {
        errorNewContent.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
});
