import '/resources/js/app.js';

// アコーディオンの切り替え
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
    // カテゴリー切り替え
    const categoryItems = document.querySelectorAll(".category-item");
    const newContent = document.getElementById('new-content');
    const allCategoryTitles = document.querySelectorAll('.category-title');  // 全てのカテゴリタイトルを取得

    categoryItems.forEach((item) => {
        item.addEventListener("click", () => {
            // data-category-id属性からカテゴリーIDを取得
            const categoryId = item.getAttribute("data-category-id");
            const categoryTitleNew = document.getElementById('category-title-new');
            document.querySelectorAll('.video-contents').forEach(button => {
                const categoryTitle = document.getElementById('category-title-' + categoryId);
                const contentCategoryId = button.getAttribute('data-content-category-id');
                const contentDetails = button.nextElementSibling;
                const show = document.querySelectorAll('.bi-chevron-down');
                const none = document.querySelectorAll('.bi-chevron-up');
                categoryTitleNew.classList.add('hidden');
                if (categoryTitle) {
                    categoryTitle.classList.add('hidden');
                }
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
                    if (categoryTitle) {  // categoryTitleが存在する場合のみ表示
                        categoryTitle.classList.remove('hidden');
                    }
                    button.classList.remove('hidden');
                    button.classList.add('flex');
                }
            });

            // 他のカテゴリータイトルを非表示に
            allCategoryTitles.forEach(title => {
                if (title.id !== 'category-title-' + categoryId) {
                    title.classList.add('hidden');
                } else {
                    title.classList.remove('hidden');
                }
            });

            // 新規コンテンツの表示
            newContent.classList.add('hidden');
            if (categoryId === '0') {
                categoryTitleNew.classList.remove('hidden');
                newContent.classList.remove('hidden');
            }
        });
    });

    // 閉じるボタンのクリックイベント
    document.querySelectorAll('.close-button').forEach(button => {
        button.addEventListener('click', () => {
            const alertArea = button.closest('.alert-area');
            alertArea.remove();
        });
    });

    // カテゴリー選択時の初期表示
    const selectedCategoryId = document.getElementById('selected-category').getAttribute('data-selected-category');
    if (selectedCategoryId) {
        const button = document.getElementById('category-list-' + selectedCategoryId);
        button.click();
    }

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
});
