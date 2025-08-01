<x-app-layout>
    <div class="bg-orange-300 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6 text-center">{{ $restaurant->name }} へのレビューを投稿</h1>

                    <div class="mb-6">
                        {{-- 店舗詳細ページに戻るリンク --}}
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="text-blue-600 hover:underline">
                            &larr; {{ $restaurant->name }} の詳細に戻る
                        </a>
                    </div>

                    {{-- バリデーションエラーメッセージの表示 --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('restaurants.reviews.store', $restaurant) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">評価 (1〜5点)</label>
                            <select name="rating" id="rating" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('rating') border-red-500 @enderror">
                                <option value="">選択してください</option>
                                @for ($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}点</option>
                                @endfor
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">コメント</label>
                            <textarea name="comment" id="comment" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') border-red-500 @enderror" placeholder="レビュー内容を記入してください">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                レビューを投稿する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>