<x-app-layout>
    <div class="flex w-full pb-12">
        {{--カテゴリー選択--}}
        <div class="side-nav fixed left-0 top-0 w-2/12 h-[100dvh] mt-16 bg-white overflow-y-auto">
            <div class="sticky top-0 left-0 category-item flex flex-col items-center w-full mx-auto px-2 py-6 border-y border-solid bg-white hover:bg-gray-200 cursor-pointer" data-category-id="0">
                <p class="font-semibold">新規登録</p>
            </div>
            @foreach($categories as $category)
                <div id="category-list-{{ $category->id }}" class="category-item flex flex-col items-center w-full mx-auto px-3 py-6 border-y border-solid hover:bg-gray-200 cursor-pointer" data-category-id="{{ $category->id }}">
                    <p class="font-semibold">{{ $category->name }}</p>
                </div>
            @endforeach
        </div>
        <div class="w-2/12"></div>
        {{--コンテンツ一覧表示--}}
        <div id="content-list" class="flex flex-col w-9/12 lg:w-8/12 mt-32 mx-auto">
            {{--新規登録--}}
            <div id="new-content" class="md:px-10 md:py-3 px-2 py-1 bg-white border-t border-solid">
                <form action="{{ route('AddContent') }}" method="POST" enctype="multipart/form-data" class="flex max-md:flex-col w-full h-full">
                    @csrf
                    <div class="flex flex-col w-full pb-4">
                        <div class="flex flex-col w-full mt-3">
                            <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                            <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                <label for="category_id" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>カテゴリー名：</label>
                                <select name="category_id" id="category_id" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2">
                                    <option value="" selected disabled>カテゴリーを選択してください</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col w-full mt-3">
                            <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                            <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                <label for="name" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>新規コンテンツ名：</label>
                                <input type="text" name="name" id="name" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" placeholder="新規コンテンツ名" />
                            </div>
                        </div>
                        <div class="flex flex-col w-full mt-3">
                            <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                            <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                <label for="url" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>新規動画URL：</label>
                                <input type="text" name="url" id="url" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" placeholder="新規動画URL" />
                            </div>
                        </div>
                        <div class="flex flex-col w-full mt-12">
                            <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                            <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                <label for="img" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>新規コンテンツ画像：</label>
                                <input type="file" name="img" id="img" class="lg:w-96 md:w-72 w-10/12 max-md:mt-3 bg-gray-50 border border-gray-300 max-lg:text-sm max-md:text-xs text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:mt-auto flex justify-center items-center max-md:my-5">
                        <button type="submit" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:ms-auto md:me-10 md:mt-auto md:mb-4 me-3 hover:bg-gray-900 hover:text-white text-nowrap">追加</button>
                    </div>
                </form>
            </div>
            {{--既存コンテンツ--}}
            @foreach ($contents as $content)
                <button class="hidden video-contents w-full text-left mb-2 px-10 py-6 font-bold text-xl bg-white hover:bg-gray-200" data-content-category-id="{{ $content->category_id }}">
                    <span class="w-full">{{ $content->name }}</span>
                    <i class="bi bi-chevron-up hidden text-2xl md:me-10 self-center"></i>
                    <i class="bi bi-chevron-down text-2xl md:me-10 self-center"></i>
                </button>
                <div class="hidden content-details md:px-10 md:py-3 px-2 py-1 bg-white border-t border-solid">
                    <form id="content-form-{{ $content->id }}" method="POST" enctype="multipart/form-data" class="flex max-md:flex-col w-full h-full">
                        @csrf
                        <div class="flex flex-col w-full pb-4">
                            <div class="flex flex-col w-full mt-3">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="category_name_{{ $content->category_id }}" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>カテゴリー名：</label>
                                    <select name="category_id" id="category_id_{{ $content->category_id }}" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $content->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-col w-full mt-3">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="name_{{ $content->id }}" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>コンテンツ名：</label>
                                    <input type="text" name="name" id="name_{{ $content->id }}" value="{{ $content->name }}" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" />
                                </div>
                            </div>
                            <div class="flex flex-col w-full mt-3">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="url_{{ $content->id }}" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>動画URL：</label>
                                    <input type="text" name="url" id="url_{{ $content->id }}" value="{{ $content->url }}" class="lg:w-96 md:w-72 w-10/12 bg-gray-50 border border-gray-300 text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500 block max-md:mt-3 p-2" />
                                </div>
                            </div>
                            <div class="flex flex-col w-full mt-12">
                                <p class="max-md:hidden bg-red-500 w-14 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</p>
                                <div class="flex flex-col w-full md:flex-row items-center mt-1">
                                    <label for="img_{{ $content->id }}" class="w-40 pe-2 text-gray-900 text-nowrap"><span class="md:hidden bg-red-500 w-14 my-auto me-2 px-2 py-[2px] text-xs text-white text-nowrap text-center rounded-xl">必須</span>コンテンツ画像：</label>
                                    <input type="file" name="img" id="img_{{ $content->id }}" class="lg:w-96 md:w-72 w-10/12 max-md:mt-3 bg-gray-50 border border-gray-300 max-lg:text-sm max-md:text-xs text-gray-900 rounded-xl focus:ring-blue-500 focus:border-blue-500" />
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:mt-auto flex justify-center items-center max-md:my-5">
                            <button type="button" data-action="{{ route('UpdateContent', $content->id) }}" onclick="submitForm({{ $content->id }}, this)" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:ms-auto md:me-10 md:mt-auto md:mb-4 me-3 hover:bg-gray-900 hover:text-white text-nowrap">更新</button>
                            <button type="button" data-action="{{ route('DeleteContent', $content->id) }}" onclick="submitForm({{ $content->id }}, this)" class="border border-gray-900 h-full px-4 py-3 rounded-xl md:me-10 md:mt-auto md:mb-4 ms-3 hover:bg-gray-900 hover:text-white text-nowrap">削除</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function submitForm(contentId, button) {
            const form = document.getElementById(`content-form-${contentId}`);
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
    @vite('resources/js/admin/content.js')
</x-app-layout>
