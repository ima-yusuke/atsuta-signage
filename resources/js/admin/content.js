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
    } else {
        const button = document.getElementById('category-list-0');
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

    // 並び替え処理
    const sortable = document.getElementById('sortable-content-list');
    Sortable.create(sortable, {
        animation: 150,
        filter: 'input, select, textarea, .update-button, delete-button',
        preventOnFilter: false,
        onSort: onSortEvent
    });
});

function onSortEvent(e) {
    const draggedCategoryId = e.item.getAttribute('data-sort-category-id');
    UpdateOrder(e.target, "sortable-item", '/dashboard/update-content-order', draggedCategoryId);
}

function UpdateOrder(target, selector, url, draggedCategoryId) {
    const items = target.querySelectorAll('.' + selector);
    let orderData = [];

    for (let i = 0; i < items.length; i++) {
        let id = items[i].id;
        orderData.push({ id: id, order: i + 1 });
    }
    UpdateContentOrderRequest(url, orderData, draggedCategoryId);
}

function UpdateContentOrderRequest(url, orderData, draggedCategoryId) {
    FetchData(url, 'POST', true, JSON.stringify({
        orderData: orderData,
        draggedCategoryId: draggedCategoryId
    }))
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function FetchData(url, method, headerData, bodyData) {
    const headers = {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    if (headerData) {
        Object.assign(headers, {
            'Content-Type': 'application/json'
        });
    }

    return fetch(url, {
        method: method,
        headers: headers,
        body: bodyData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .catch(error => {
            console.error('Error:', error);
            throw new Error(error.message);
        });
}
