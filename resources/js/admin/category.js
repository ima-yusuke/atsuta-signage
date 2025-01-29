import '/resources/js/app.js';
import Sortable from "sortablejs";

document.addEventListener('DOMContentLoaded', () => {
    // アコーディオンの切り替え
    document.querySelectorAll('#sortable-category-list > .sortable-item > .categories').forEach(button => {
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

    // 並び替え処理
    const sortable = document.getElementById('sortable-category-list');
    Sortable.create(sortable, {
        animation: 150,
        onSort: onSortEvent
    });
});


function onSortEvent(e) {
    UpdateOrder(e.target, "sortable-item", '/dashboard/update-category-order');
}

function UpdateOrder(target, selector, url) {
    const items = target.querySelectorAll('.' + selector);
    let orderData = [];

    for (let i = 0; i < items.length; i++) {
        let id = items[i].id;
        orderData.push({ id: id, order: i + 1 });
    }
    UpdateCategoryOrderRequest(url, orderData);
}

function UpdateCategoryOrderRequest(url, orderData) {
    FetchData(url, 'POST', true, JSON.stringify({
        orderData: orderData,
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
