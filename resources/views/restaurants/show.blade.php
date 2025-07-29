<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }} の詳細
        </h2>
    </x-slot>

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
                        <h1 class="text-4xl font-bold mb-4">{{ $restaurant->name }}</h1>
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

                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-2">基本情報</h3>
                            <p class="text-gray-600 mb-1"><strong class="font-medium">住所:</strong> {{ $restaurant->address }}</p>
                            <p class="text-gray-600 mb-1"><strong class="font-medium">電話番号:</strong> {{ $restaurant->telephone }}</p>
                            <p class="text-gray-600"><strong class="font-medium">営業時間:</strong> {{ $restaurant->operating_hours }}</p>
                        </div>
                        
                        {{-- 予約リンクなど、追加のボタンがあればここに --}}
                        <div class="mt-6 text-right">
                            <a href="{{ route('restaurants.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                一覧に戻る
                            </a>
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-200">

                {{-- 口コミセクション --}}
                <div class="mt-8">
                    <h2 class="text-3xl font-bold mb-6">口コミ ({{ $restaurant->reviews->count() }}件)</h2>

                    @forelse ($restaurant->reviews as $review)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-4 shadow-sm">
                            <div class="flex items-center mb-3">
                                <p class="font-semibold text-lg text-gray-800 mr-3">{{ $review->user->name ?? '名無しさん' }}</p> {{-- ユーザー名を表示 --}}
                                <p class="text-yellow-500 text-xl">
                                    @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
                                </p>
                                <p class="text-gray-500 text-sm ml-auto">{{ $review->created_at->format('Y/m/d H:i') }}</p>
                            </div>
                            <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>
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
</x-app-layout>