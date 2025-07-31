<x-app-layout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 bg-orange-300 py-12">

            <div class="relative bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/yakiniku_background.jpg') }}');"></div>
                <div class="relative p-8 text-gray-900 text-center">
                    <p class="mb-6 text-2xl font-bold text-gray-800 leading-tight underline decoration-orange-500 decoration-8">
                        {{ __("京都でおすすめの焼肉屋をみんなで作ろう") }}
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center items-center gap-6"> {{-- 中央寄せとギャップを調整 --}}
                        <a href="{{ route('restaurants.index') }}" class="
                            inline-flex items-center justify-center
                            px-8 py-3 bg-red-600 border border-transparent rounded-full {{-- 大きく、丸いボタンに --}}
                            font-bold text-base text-white uppercase tracking-wider {{-- フォントを太く、大きく --}}
                            shadow-lg hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:opacity-25
                            transition ease-in-out duration-300 transform hover:scale-105 {{-- ホバー効果を強化 --}}
                        ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
</svg>

                            {{ __('焼肉店を探索する') }}
                        </a>
                        <a href="{{ route('restaurants.create') }}" class="
                            inline-flex items-center justify-center
                            px-8 py-3 bg-gray-800 border-2 border-gray-800 rounded-full {{-- 大きく、丸いボタンに、枠線も --}}
                            font-bold text-base text-white uppercase tracking-wider
                            shadow-lg hover:bg-gray-700 hover:border-gray-700 active:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:opacity-25
                            transition ease-in-out duration-300 transform hover:scale-105
                        ">
                            {{ __('新しいお店を登録する') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">{{ __('あなたの最近のレビュー') }}</h3>
                    @if ($userReviews->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($userReviews as $review)
                                <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-150 ease-in-out">
                                    {{-- ここに画像表示ロジックがあったはずですが、省略されています。必要であれば以前の修正を適用してください。 --}}
                                    <h4 class="font-bold text-md mb-1">
                                        @if($review->restaurant)
                                            <a href="{{ route('restaurants.show', $review->restaurant) }}" class="text-indigo-600 hover:text-indigo-800">
                                                {{ $review->restaurant->name }}
                                            </a>
                                        @else
                                            {{ __('不明な店舗') }}
                                        @endif
                                    </h4>
                                    {{-- 星の表示 --}}
                                    <div class="flex items-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.426 8.204 1.192-5.95 5.808 1.403 8.165L12 18.006l-7.325 3.856 1.403-8.165-5.95-5.808 8.204-1.192z"/></svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.426 8.204 1.192-5.95 5.808 1.403 8.165L12 18.006l-7.325 3.856 1.403-8.165-5.95-5.808 8.204-1.192z"/></svg>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">{{ $review->rating }}/5</span>
                                    </div>
                                    <p class="text-gray-700 text-sm mb-2">{{ Str::limit($review->comment, 100) }}</p>
                                    <div class="text-right text-xs text-gray-500">
                                        {{ $review->created_at->format('Y/m/d') }} 投稿
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @else
                        <p class="text-gray-600">{{ __('まだレビューを投稿していません。ぜひ最初のレビューを投稿してみましょう！') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">{{ __('評価3以上のおすすめ焼肉店') }}</h3>
                    @if ($highlyRatedRestaurants->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"> {{-- カードを並べるグリッドレイアウト --}}
                            @foreach ($highlyRatedRestaurants as $restaurant)
                                <a href="{{ route('restaurants.show', $restaurant) }}" class="block border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-150 ease-in-out transform hover:scale-105 cursor-pointer">
                                    {{-- 店舗画像を表示 --}}
                                    @if($restaurant->image_url) {{-- ここを image_url に変更 --}}
                                        <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="w-full h-32 object-cover rounded-md mb-3"> {{-- srcも asset($path) に変更 --}}
                                    @else
                                        {{-- 画像がない場合のデフォルト画像 --}}
                                        <img src="{{ asset('images/default_restaurant.png') }}" alt="Default Restaurant Image" class="w-full h-32 object-cover rounded-md mb-3">
                                    @endif

                                    <h4 class="font-bold text-md mb-1">
                                        {{-- 店舗名もaタグではなく直接表示 --}}
                                        <span class="text-indigo-600 group-hover:text-indigo-800">{{ $restaurant->name }}</span>
                                    </h4>
                                    @if(isset($restaurant->avg_rating))
                                        <p class="text-sm text-gray-600">平均評価: {{ number_format($restaurant->avg_rating, 1) }} / 5.0</p>
                                    @else
                                        <p class="text-sm text-gray-600">{{ __('評価未算出') }}</p>
                                    @endif
                                    <p class="text-gray-700 text-sm mb-2">{{ Str::limit($restaurant->description, 100) }}</p>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('restaurants.index', ['filter_rating' => 3]) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('すべての焼肉店を見る') }} &rarr;
                            </a>
                        </div>
                    @else
                        <p class="text-gray-600">{{ __('現在、評価3以上のおすすめ焼肉店はありません。') }}</p>
                    @endif
                </div>
            </div>

        </div>
</x-app-layout>