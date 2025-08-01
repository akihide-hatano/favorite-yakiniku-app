<x-app-layout>
    {{-- 画面幅いっぱいの背景色を適用する外側のdiv --}}
    <div class="bg-orange-300 py-12">

        {{-- コンテンツを中央寄せする内側のdiv --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- トップの焼肉屋紹介セクション --}}
            <div class="relative bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/yakiniku_background.jpg') }}');"></div>
                <div class="relative p-8 text-gray-900 text-center">
                    <p class="mb-6 text-2xl font-bold text-gray-800 leading-tight underline decoration-orange-500 decoration-8">
                        {{ __("京都でおすすめの焼肉屋をみんなで作ろう") }}
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                        <a href="{{ route('restaurants.index') }}" class="
                            inline-flex items-center justify-center
                            px-8 py-3 bg-red-600 border border-transparent rounded-full
                            font-bold text-base text-white uppercase tracking-wider
                            shadow-lg hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:opacity-25
                            transition ease-in-out duration-300 transform hover:scale-105
                        ">
                            <x-icons.search class="size-6 mr-2"/>
                            <span>
                                {{ __('焼肉店を探索する') }}
                            </span>
                        </a>
                        <a href="{{ route('restaurants.create') }}" class="
                            inline-flex items-center justify-center
                            px-8 py-3 bg-gray-800 border-2 border-gray-800 rounded-full
                            font-bold text-base text-white uppercase tracking-wider
                            shadow-lg hover:bg-gray-700 hover:border-gray-700 active:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 disabled:opacity-25
                            transition ease-in-out duration-300 transform hover:scale-105
                        ">
                            <x-icons.pencil class="size-6 mr-2"/>
                            <span>
                                {{ __('新しいお店を登録する') }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ユーザーの最近のレビューセクション --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-800">
                    <h3 class="font-semibold text-lg mb-4 text-center">{{ __('あなたの最近のレビュー') }}</h3>
                    @if ($userReviews->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($userReviews as $review)
                                <div class="border-2 border-gray-300 rounded-lg p-4 shadow-sm hover:border-gray-500 transition duration-150 ease-in-out">
                                    <h4 class="font-bold text-md mb-1">
                                        @if($review->restaurant)
                                            <a href="{{ route('restaurants.show', $review->restaurant) }}" class="text-indigo-600 hover:text-indigo-800">
                                                {{ $review->restaurant->name }}
                                            </a>
                                        @else
                                            {{ __('不明な店舗') }}
                                        @endif
                                    </h4>
                                    {{-- Heroiconsの星アイコンコンポーネントを使用 --}}
                                    <div class="flex items-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <x-icons.star-solid />
                                            @else
                                                <x-icons.star-outline />
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

            {{-- 評価3以上のおすすめ焼肉店セクション --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">{{ __('評価3以上のおすすめ焼肉店') }}</h3>
                    @if ($highlyRatedRestaurants->isNotEmpty())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($highlyRatedRestaurants as $restaurant)
                                <a href="{{ route('restaurants.show', $restaurant) }}" class="block border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition duration-150 ease-in-out transform hover:scale-105 cursor-pointer">
                                    @if($restaurant->image_url)
                                        <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="w-full h-32 object-cover rounded-md mb-3">
                                    @else
                                        <img src="{{ asset('images/default_restaurant.png') }}" alt="Default Restaurant Image" class="w-full h-32 object-cover rounded-md mb-3">
                                    @endif

                                    <h4 class="font-bold text-md mb-1">
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
                            <span class="mr-2">{{ __('すべての焼肉店を見る') }}</span>
                            <x-icons.arrow-right class="size-6"/>
                        </a>
                    </div>
                    @else
                        <p class="text-gray-600">{{ __('現在、評価3以上のおすすめ焼肉店はありません。') }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>