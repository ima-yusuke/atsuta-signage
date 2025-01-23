<x-app-layout>
    <div class="flex flex-col justify-center items-center w-full py-12">
        <!-- カテゴリー一覧表示 -->
        <div id="category-list" class="flex flex-col w-10/12 mt-8 border border-solid border-gray-200 bg-white">
            @foreach ($categories as $category)
                <button class="categories flex w-full text-left px-10 py-6 bg-white font-bold text-xl hover:bg-gray-200">
                    <span class="w-full">{{ $category->name }}</span>
                    <i class="bi bi-chevron-up hidden text-2xl me-10"></i>
                    <i class="bi bi-chevron-down text-2xl me-10"></i>

                </button>
                <div class="hidden px-10 py-3 bg-white border-t">
                    <form action="{{ route('UpdateCategory', $category->id) }}" method="POST" enctype="multipart/form-data" class="flex w-full h-full">
                        @csrf
                        <div class="flex flex-col pb-4">
                            <div class="flex flex-col md:flex-row items-center mt-3">
                                <label for="name_{{ $category->id }}" class="pe-2 text-gray-900 text-nowrap">カテゴリー名：</label>
                                <input type="text" name="name" id="name_{{ $category->id }}" value="{{ $category->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2" />
                            </div>
                            <div class="flex flex-col md:flex-row items-center mt-8">
                                <label for="img_{{ $category->id }}" class="pe-2 text-gray-900 text-nowrap">カテゴリー画像：</label>
                                <input type="file" name="img" id="img_{{ $category->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                        <button type="submit" class="border border-gray-900 h-full px-4 py-3 rounded-xl ms-auto me-10 mt-auto mb-4 hover:bg-gray-900 hover:text-white text-nowrap">更新</button>
                    </form>
                    <form action="{{ route('DeleteCategory', $category->id) }}" method="POST" class="h-full me-10 mt-auto mb-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border border-gray-900 h-full px-4 py-3 rounded-xl hover:bg-gray-900 hover:text-white text-nowrap">削除</button>
                    </form>
                </div>
            @endforeach
        </div>
        {{--新規カテゴリー追加--}}
        <div class="flex flex-col w-10/12 border border-solid border-gray-200 bg-white px-8 py-5">
            <p class="text-xl pb-2">新規属性カテゴリー追加</p>
            <form action="{{ route('AddCategory') }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                <div class="flex flex-col w-full pt-8 pb-4">
                    <div class="flex flex-col">
                        <p class="bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                        <div class="flex flex-col md:flex-row items-center mt-1">
                            <label for="category" class="pe-2 text-gray-900 text-nowrap">新規カテゴリー名：</label>
                            <input type="text" name="name" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="新規カテゴリー名" />
                        </div>
                    </div>
                    <div class="flex flex-col mt-12">
                        <p class="bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                        <div class="flex flex-col md:flex-row items-center mt-3">
                            <label for="img" class="pe-2 text-gray-900 text-nowrap">新規カテゴリー画像：</label>
                            <input type="file" name="img" id="img" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
                <button type="submit" class="border border-gray-900 h-full px-4 py-3 rounded-xl ms-auto me-10 mt-auto mb-4 hover:bg-gray-900 hover:text-white text-nowrap">追加</button>
            </form>
        </div>
    </div>
    @vite('resources/js/admin/category.js')
</x-app-layout>
