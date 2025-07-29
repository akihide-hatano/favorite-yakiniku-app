<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新しい焼肉店を登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6 text-center">新しい焼肉店を登録</h1>

                    {{-- バリデーションエラーメッセージの表示 --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">入力エラーがあります:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                        <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf {{-- CSRFトークンの埋め込み --}}

                            {{-- 店名 --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    店名 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                       id="name" name="name" type="text" placeholder="例: 炭火焼肉 炎庵" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 説明 --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    説明 <span class="text-red-500">*</span>
                                </label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32 resize-y @error('description') border-red-500 @enderror" 
                                          id="description" name="description" placeholder="お店の特徴やこだわりを記入" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 住所 --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                                    住所 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" 
                                       id="address" name="address" type="text" placeholder="例: 京都市中京区河原町通三条上る" value="{{ old('address') }}" required>
                                @error('address')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 電話番号 --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                                    電話番号 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone') border-red-500 @enderror" 
                                       id="telephone" name="telephone" type="text" placeholder="例: 075-123-4567" value="{{ old('telephone') }}" required>
                                @error('telephone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 営業時間 --}}
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="operating_hours">
                                    営業時間 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('operating_hours') border-red-500 @enderror" 
                                       id="operating_hours" name="operating_hours" type="text" placeholder="例: 月～金: 17:00～23:00" value="{{ old('operating_hours') }}" required>
                                @error('operating_hours')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 店舗画像 --}}
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                    店舗画像
                                </label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('image') border-red-500 @enderror" 
                                       id="image" name="image" type="file" accept="image/*">
                                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, JPEG, GIF形式の画像ファイル (最大2MB)</p>
                                @error('image')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ボタン --}}
                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out" type="submit">
                                    登録する
                                </button>
                                <a href="{{ route('restaurants.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 transition duration-150 ease-in-out">
                                    一覧に戻る
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>