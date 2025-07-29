<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('焼肉店一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-2xl font-bold mb-4">焼肉店検索</h3>

                {{-- 検索フォーム --}}
                <form action="{{ route('restaurants.index') }}" method="GET" class="mb-6 flex items-center space-x-4">
                    <input type="text" name="search" placeholder="店舗名やキーワードで検索"
                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm flex-grow"
                           value="{{ request('search') }}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        検索
                    </button>
                </form>

                {{-- 並び替えと絞り込みのコントロール --}}
                <div class="mb-4 flex flex-wrap gap-4 items-center">
                    <span class="font-bold">並び替え:</span>
                    <a href="{{ route('restaurants.index', array_merge(request()->query(), ['sort' => 'rating', 'page' => 1])) }}"
                       class="text-blue-600 hover:underline @if(request('sort') == 'rating' || (!request()->has('sort') && !request()->has('search') && !request()->has('rating') && !request()->has('location'))) font-bold @endif">
                       評価順
                    </a>
                    <a href="{{ route('restaurants.index', array_merge(request()->query(), ['sort' => 'reviews_count', 'page' => 1])) }}"
                       class="text-blue-600 hover:underline @if(request('sort') == 'reviews_count') font-bold @endif">
                       口コミ数順
                    </a>

                    <span class="font-bold ml-auto">評価:</span>
                    <form action="{{ route('restaurants.index') }}" method="GET" class="inline-flex items-center">
                        @foreach(request()->except(['rating', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="rating" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">全て</option>
                            <option value="1" @if(request('rating') == 1) selected @endif>1以上</option>
                            <option value="2" @if(request('rating') == 2) selected @endif>2以上</option>
                            <option value="3" @if(request('rating') == 3) selected @endif>3以上</option>
                            <option value="4" @if(request('rating') == 4) selected @endif>4以上</option>
                            <option value="5" @if(request('rating') == 5) selected @endif>5以上</option>
                        </select>
                    </form>
                    
                    <span class="font-bold">場所:</span>
                    <form action="{{ route('restaurants.index') }}" method="GET" class="inline-flex items-center">
                        @foreach(request()->except(['location', 'page']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="location" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">全て</option>
                            <option value="京都市中京区" @if(request('location') == '京都市中京区') selected @endif>中京区</option>
                            <option value="京都市下京区" @if(request('location') == '京都市下京区') selected @endif>下京区</option>
                            <option value="京都市東山区" @if(request('location') == '京都市東山区') selected @endif>東山区</option>
                            <option value="京都駅" @if(request('location') == '京都駅') selected @endif>京都駅周辺</option>
                            <option value="河原町" @if(request('location') == '河原町') selected @endif>河原町周辺</option>
                            <option value="祇園" @if(request('location') == '祇園') selected @endif>祇園周辺</option>
                            <option value="伏見区" @if(request('location') == '伏見区') selected @endif>伏見区</option>
                            <option value="北区" @if(request('location') == '北区') selected @endif>北区</option>
                        </select>
                    </form>
                </div>

                {{-- レストランリストをカード形式で表示 --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> {{-- グリッドレイアウトを追加 --}}
                    @forelse ($restaurants as $restaurant)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden transition-shadow hover:shadow-lg"> {{-- カードスタイル --}}
                            @if ($restaurant->image_url)
                                <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="w-full h-48 object-cover">
                            @else
                                {{-- 画像がない場合のプレースホルダー --}}
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">画像なし</div>
                            @endif
                            <div class="p-4">
                                <h4 class="text-xl font-semibold mb-2">
                                    <a href="{{ route('restaurants.show', $restaurant) }}" class="text-blue-600 hover:underline">
                                        {{ $restaurant->name }}
                                    </a>
                                </h4>
                                <div class="flex items-center mb-2">
                                    @if (isset($restaurant->reviews_avg_rating))
                                        <span class="text-yellow-500 text-lg mr-1">★</span>
                                        <span class="text-gray-700 text-base font-medium">{{ number_format($restaurant->reviews_avg_rating, 1) }}</span>
                                    @else
                                        <span class="text-gray-500 text-sm">評価なし</span>
                                    @endif
                                    @if (isset($restaurant->reviews_count))
                                        <span class="text-gray-500 text-sm ml-2">({{ $restaurant->reviews_count }}件の口コミ)</span>
                                    @else
                                        <span class="text-gray-500 text-sm ml-2">(口コミなし)</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $restaurant->description }}</p> {{-- 2行に制限 --}}
                                <p class="text-gray-500 text-xs">住所: {{ $restaurant->address }}</p>
                                {{-- ここに他の情報（営業時間など）を追加できます --}}
                                <div class="mt-4 text-right">
                                    <a href="{{ route('restaurants.show', $restaurant) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        詳細を見る
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">お探しの条件に合う焼肉店は見つかりませんでした。</p>
                    @endforelse
                </div>

                {{-- ページネーションリンク --}}
                {{-- <div class="mt-8">
                    {{ $restaurants->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>