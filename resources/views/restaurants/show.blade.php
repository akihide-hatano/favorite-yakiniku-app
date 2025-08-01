<x-app-layout>
    <div class="bg-orange-300">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <div class="md:flex md:space-x-8">
                    {{-- 店舗画像 --}}
                    <div class="md:w-1/2 mb-6 md:mb-0">
                        @if ($restaurant->image_url)
                            <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="w-full h-96 object-cover rounded-lg shadow-md">
                        @else
                            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-500 text-2xl rounded-lg shadow-md">画像なし</div>
                        @endif
                    </div>

                    {{-- 店舗情報 --}}
                    <div class="md:w-1/2">
                        <h1 class="text-3xl font-bold mb-4 underline decoration-orange-500 decoration-4">{{ $restaurant->name }}</h1>
                        <div class="flex items-center mb-4 text-xl">
                            @if (isset($restaurant->reviews_avg_rating))
                                <span class="text-yellow-500 mr-2">★</span>
                                <span class="font-semibold">{{ number_format($restaurant->reviews_avg_rating, 1) }}</span>
                                <span class="text-gray-500 text-sm ml-2">({{ $restaurant->reviews->count() }}件の口コミ)</span>
                            @else
                                <span class="text-gray-500 text-lg">評価はまだありません</span>
                            @endif
                        </div>

                        <p class="text-gray-700 text-lg mb-4 leading-relaxed">{{ $restaurant->description }}</p>

                        <div class="mb-4 bg-gray-100 border border-gray-200 rounded-md p-4">
                            <h3 class="text-lg font-semibold mb-2 text-orange-500 flex items-center">
                                <x-icons.information-circle class="w-5 h-5 mr-2" />
                                基本情報
                            </h3>
                            <p class="text-gray-600 mb-1 flex items-center">
                                <x-icons.map-pin/>
                                <strong class="font-medium ml-2">住所:</strong> {{ $restaurant->address }}
                            </p>
                            <p class="text-gray-600 mb-1 flex items-center">
                                <x-icons.phone/>
                                <strong class="font-medium ml-2">電話番号:</strong> {{ $restaurant->telephone }}
                            </p>
                            <p class="text-gray-600 flex items-center">
                                <x-icons.clock />
                                <strong class="font-medium ml-2">営業時間:</strong> {{ $restaurant->operating_hours }}
                            </p>
                        </div>
                        {{-- ボタン群 --}}
                        <div class="mt-8 flex justify-start items-center space-x-4">
                            {{-- 一覧に戻るボタン --}}
                            <a href="{{ route('restaurants.index') }}" class="px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                一覧に戻る
                            </a>
                            {{-- 編集ボタン --}}
                            <a href="{{ route('restaurants.edit', $restaurant) }}" class="bg-green-500 hover:bg-green-700 text-white text-xs font-semibold px-4 py-2 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                編集する
                            </a>
                            {{-- 削除ボタン --}}
                            <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('本当にこの店舗を削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE') {{-- DELETEメソッドを使用することを指定 --}}
                                <button type="submit" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    削除する
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-200">

                {{-- 口コミセクション --}}
                <div class="flex justify-start items-center gap-10 mb-6">
                    <h2 class="text-3xl font-bold">口コミ ({{ $restaurant->reviews->count() }}件)</h2>
                    <a href="{{ route('restaurants.reviews.create', $restaurant )}}" class="inline-flex items-center bg-gray-700 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                        <x-icons.pencil/>
                        <span class="ml-2">レビューを投稿する</span>
                    </a>
                </div>

                    @forelse ($restaurant->reviews as $review)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-3 shadow-sm">
                            <div class="flex items-center mb-3">
                                <p class="font-semibold text-lg text-gray-800 mr-3">{{ $review->user->name ?? '名無しさん' }}</p>
                                <p class="text-yellow-500 text-xl">
                                    @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
                                </p>
                                <p class="text-gray-500 text-sm ml-auto">{{ $review->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
                            @auth {{-- ログインしている場合のみ表示 --}}
                            @if (Auth::id() === $review->user_id) {{-- ログインユーザーがこの口コミの投稿者である場合のみ表示 --}}
                            <div class="mt-2 flex justify-end space-x-2">
                                {{-- 編集ボタン --}}
                                <a href="{{ route('restaurants.reviews.edit', [$restaurant, $review]) }}" class="inline-flex items-center px-3 py-1 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600 focus:bg-green-600 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    編集
                                </a>
                                {{-- 削除ボタン --}}
                                <form action="{{ route('restaurants.reviews.destroy', [$restaurant, $review]) }}" method="POST" onsubmit="return confirm('本当にこの口コミを削除してもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        削除
                                    </button>
                                </form>
                            </div>
                            @endif
                            @endauth
                            {{-- ★★★ ここまで編集・削除ボタンを追加 ★★★ --}}
                        </div>
                            @empty
                            <p class="text-gray-600">この焼肉店にはまだ口コミがありません。</p>
                            @endforelse
                    </div>

                {{-- 口コミ投稿フォーム（後で実装） --}}
                {{-- <div class="mt-8">
                    <h2 class="text-3xl font-bold mb-6">口コミを投稿する</h2>
                    </div> --}}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>