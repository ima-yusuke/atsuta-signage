import '/resources/js/app.js';
// resources/js/admin/sort.js
import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', () => {
    const categoryList = document.getElementById('categories');
    let contents = []; // ここでcontentsを定義

    const updateOrder = () => {
        const categories = [];

        // カテゴリの並べ替え
        categoryList.querySelectorAll('.category-item').forEach((item, index) => {
            const id = item.getAttribute('data-id');
            const parentId = item.getAttribute('data-parent-id');
            categories.push({
                id: id,
                order: index,
                parent_id: parentId === 'null' ? null : parentId,
                children: [] // 子カテゴリーの並び順も送信
            });

            // 子カテゴリーの並べ替え
            item.querySelectorAll('.category-item').forEach((subItem, subIndex) => {
                const subId = subItem.getAttribute('data-id');
                categories[categories.length - 1].children.push({
                    id: subId,
                    order: subIndex,
                    parent_id: id
                });
            });

            // コンテンツの並べ替え
            const contentList = item.querySelector('.content-list');
            contentList.querySelectorAll('.content-item').forEach((contentItem, contentIndex) => {
                const contentId = contentItem.getAttribute('data-id');
                const categoryId = item.getAttribute('data-id');
                contents.push({
                    id: contentId,
                    order: contentIndex,
                    category_id: categoryId
                });
            });
        });

        // APIにデータを送信
        fetch('/dashboard/update-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ categories, contents }) // contentsをここで送信
        }).then(response => response.json())
            .then(data => console.log('Order updated:', data))
            .catch(error => console.error('Error:', error));
    };

    new Sortable(categoryList, {
        group: 'categories',
        onEnd(evt) {
            // ドラッグしたアイテムが右寄りか左寄りかを判定
            const rect = evt.item.getBoundingClientRect();
            const categoryContainer = categoryList.getBoundingClientRect();
            const isRight = rect.left > categoryContainer.left + categoryContainer.width / 2;  // 右寄りの場合

            // 左寄りなら並び順、右寄りなら階層変更
            if (isRight) {
                // 階層変更処理（親IDを変更）
                const parentCategoryId = evt.from.closest('.category-item')?.getAttribute('data-id') || null;
                evt.item.setAttribute('data-parent-id', parentCategoryId);
            } else {
                // 順番の並び替え処理
                evt.item.setAttribute('data-parent-id', null); // 親カテゴリーを削除
            }

            updateOrder();  // 最後に並び替えと親カテゴリーの更新
        },
        handle: '.category-item',
        onStart(evt) {
            evt.item.style.transform = "translate(0, 0)"; // 初期位置をリセット
        },
        onUpdate(evt) {
            // 並べ替えが終わった時に親カテゴリーの更新を行う
            const parentCategoryId = evt.from.closest('.category-item')?.getAttribute('data-id') || null;
            evt.item.setAttribute('data-parent-id', parentCategoryId);

            // 親カテゴリーが変更された場合のみparent_idを更新
            if (parentCategoryId !== evt.item.getAttribute('data-parent-id')) {
                evt.item.setAttribute('data-parent-id', parentCategoryId);
            }
        }
    });

    // コンテンツの並べ替え
    const contentLists = document.querySelectorAll('.content-list');
    contentLists.forEach(contentList => {
        new Sortable(contentList, {
            group: 'contents',
            onEnd: updateOrder,
            handle: '.content-item',
        });
    });
});
