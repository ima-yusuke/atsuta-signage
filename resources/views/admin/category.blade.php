<x-app-layout>
    <div class="flex flex-col justify-center items-center w-full py-12">
        <!-- カテゴリー一覧表示 -->
        <div id="category-list" class="flex flex-col w-11/12 lg:w-10/12 mt-20">
            @foreach ($categories as $category)
                <button class="categories flex w-full text-left mb-2 px-10 py-6 font-bold text-xl bg-white hover:bg-gray-200">
                    <span class="w-full">{{ $category->name }}</span>
                    <i class="bi bi-chevron-up hidden text-2xl md:me-10 self-center"></i>
                    <i class="bi bi-chevron-down text-2xl md:me-10 self-center"></i>
                </button>
                <div class="hidden md:px-10 md:py-3 px-2 py-1 bg-white border-t border-solid">
                    <form id="category-form-{{ $category->id }}" method="POST" enctype="multipart/form-data" class="flex max-md:flex-col w-full h-full">
                        @csrf
                        <div class="flex flex-col w-full pb-4">
                            <div class="flex flex-col w-full mt-3">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="name_{{ $category->id }}" class="w-48 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>カテゴリー名：</label>
                                    <input type="text" name="name" id="name_{{ $category->id }}" value="{{ $category->name }}" class="lg:w-96 md:w-72 w-9/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" />
                                </div>
                            </div>
                            <div class="flex flex-col w-full mt-12">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="img_{{ $category->id }}" class="w-48 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>カテゴリー画像：</label>
                                    <input type="file" name="img" id="img_{{ $category->id }}" class="lg:w-96 md:w-72 w-10/12 max-md:mt-3 bg-gray-50 border border-gray-300 max-lg:text-sm max-md:text-xs text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-full md:mt-auto flex justify-center items-center max-md:my-5">
                            <button type="button" data-action="{{ route('UpdateCategory', $category->id) }}" onclick="submitForm({{ $category->id }}, this)" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:ms-auto md:me-10 md:mt-auto md:mb-4 me-3 hover:bg-gray-900 hover:text-white text-nowrap">更新</button>
                            <button type="button" data-action="{{ route('DeleteCategory', $category->id) }}" onclick="submitForm({{ $category->id }}, this)" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:me-10 md:mt-auto md:mb-4 ms-3 hover:bg-gray-900 hover:text-white text-nowrap">削除</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
        {{--新規カテゴリー追加--}}
        <div class="flex flex-col w-11/12 lg:w-10/12 border border-solid border-gray-200 bg-white md:px-10 md:py-3 px-2 py-1">
            <p class="text-xl font-bold max-md:ps-8 pt-5">新規属性カテゴリー追加</p>
            <form action="{{ route('AddCategory') }}" method="POST" enctype="multipart/form-data" class="flex max-md:flex-col">
                @csrf
                <div class="flex flex-col w-full pt-8 pb-4">
                    <div class="flex flex-col w-full">
                        <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                        <div class="flex flex-col w-full md:flex-row items-center mt-1">
                            <label for="category" class="w-48 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>新規カテゴリー名：</label>
                            <input type="text" name="name" id="category" class="lg:w-96 md:w-72 w-9/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" placeholder="新規カテゴリー名" />
                        </div>
                    </div>
                    <div class="flex flex-col w-full mt-12">
                        <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                        <div class="flex flex-col md:flex-row items-center mt-1">
                            <label for="img" class="w-48 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>新規カテゴリー画像：</label>
                            <input type="file" name="img" id="img" class="lg:w-96 md:w-72 w-10/12 max-md:mt-3 bg-gray-50 border border-gray-300 max-lg:text-sm max-md:text-xs text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                <button type="submit" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:ms-auto md:me-10 md:mt-auto md:mb-4 max-md:mx-auto max-md:my-5 hover:bg-gray-900 hover:text-white text-nowrap">追加</button>
            </form>
        </div>
    </div>
    <script>
        function submitForm(categoryId, button) {
            const form = document.getElementById(`category-form-${categoryId}`);
            form.action = button.getAttribute('data-action');
            if (button.textContent.trim() === '削除') {
                form.method = 'POST';
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);
            }
            form.submit();
        }
    </script>
    @vite('resources/js/admin/category.js')
</x-app-layout>
