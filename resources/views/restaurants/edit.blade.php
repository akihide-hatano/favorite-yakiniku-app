<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('焼肉店情報を編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6 text-center">「{{ $restaurant->name }}」の情報を編集</h1>

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
                        <form action="{{ route('restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    店名 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                       id="name" name="name" type="text" placeholder="例: 炭火焼肉 炎庵" value="{{ old('name', $restaurant->name) }}" required>
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    説明 <span class="text-red-500">*</span>
                                </label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32 resize-y @error('description') border-red-500 @enderror" 
                                          id="description" name="description" placeholder="お店の特徴やこだわりを記入" required>{{ old('description', $restaurant->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                                    住所 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" 
                                       id="address" name="address" type="text" placeholder="例: 京都市中京区河原町通三条上る" value="{{ old('address', $restaurant->address) }}" required>
                                @error('address')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                                    電話番号 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('telephone') border-red-500 @enderror" 
                                       id="telephone" name="telephone" type="text" placeholder="例: 075-123-4567" value="{{ old('telephone', $restaurant->telephone) }}" required>
                                @error('telephone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="operating_hours">
                                    営業時間 <span class="text-red-500">*</span>
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('operating_hours') border-red-500 @enderror" 
                                       id="operating_hours" name="operating_hours" type="text" placeholder="例: 月～金: 17:00～23:00" value="{{ old('operating_hours', $restaurant->operating_hours) }}" required>
                                @error('operating_hours')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                    店舗画像 (変更しない場合は空のままでOK)
                                </label>
                                @if ($restaurant->image_url)
                                    <div class="mb-2">
                                        <p class="text-gray-600 text-sm">現在の画像:</p>
                                        <img src="{{ asset($restaurant->image_url) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @endif
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('image') border-red-500 @enderror" 
                                       id="image" name="image" type="file" accept="image/*">
                                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, JPEG, GIF形式の画像ファイル (最大2MB)</p>
                                @error('image')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out" type="submit">
                                    更新する
                                </button>
                                <a href="{{ route('restaurants.show', $restaurant) }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800 transition duration-150 ease-in-out">
                                    詳細に戻る
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>