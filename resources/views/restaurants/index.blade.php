<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('焼肉店一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- 新しい2カラムのグリッドコンテナ --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6"> {{-- md:grid-cols-3で3カラムにし、その比率を操作 --}}

                {{-- 左側のサイドバー（検索・絞り込みフォーム） - 1/3幅 --}}
                <div class="md:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">焼肉店検索</h3>

                    {{-- 検索フォーム --}}
                    {{-- flex-growを削除し、フォーム自体が全幅になるように変更 --}}
                    <form action="{{ route('restaurants.index') }}" method="GET" class="mb-6">
                        <input type="text" name="search" placeholder="店舗名やキーワードで検索"
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mb-2" {{-- w-fullで親要素の幅いっぱいに --}}
                               value="{{ request('search') }}">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            検索
                        </button>
                    </form>

                    {{-- 並び替えのコントロール --}}
                    <div class="mb-6">
                        <span class="font-bold block mb-2">並び替え:</span>
                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('restaurants.index', array_merge(request()->query(), ['sort' => 'rating', 'page' => 1])) }}"
                               class="text-blue-600 hover:underline @if(request('sort') == 'rating' || (!request()->has('sort') && !request()->has('search') && !request()->has('rating') && !request()->has('location'))) font-bold @endif">
                               評価順
                            </a>
                            <a href="{{ route('restaurants.index', array_merge(request()->query(), ['sort' => 'reviews_count', 'page' => 1])) }}"
                               class="text-blue-600 hover:underline @if(request('sort') == 'reviews_count') font-bold @endif">
                               口コミ数順
                            </a>
                        </div>
                    </div>

                    {{-- 評価での絞り込み --}}
                    <div class="mb-6">
                        <span class="font-bold block mb-2">評価:</span>
                        <form action="{{ route('restaurants.index') }}" method="GET" class="block">
                            @foreach(request()->except(['rating', 'page']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="rating" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="">全て</option>
                                <option value="1" @if(request('rating') == 1) selected @endif>1以上</option>
                                <option value="2" @if(request('rating') == 2) selected @endif>2以上</option>
                                <option value="3" @if(request('rating') == 3) selected @endif>3以上</option>
                                <option value="4" @if(request('rating') == 4) selected @endif>4以上</option>
                                <option value="5" @if(request('rating') == 5) selected @endif>5以上</option>
                            </select>
                        </form>
                    </div>
                    
                    {{-- 場所での絞り込み --}}
                    <div class="mb-4">
                        <span class="font-bold block mb-2">場所:</span>
                        <form action="{{ route('restaurants.index') }}" method="GET" class="block">
                            @foreach(request()->except(['location', 'page']) as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="location" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
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
                </div>

                {{-- 右側の店舗一覧 - 2/3幅 --}}
                <div class="md:col-span-3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">店舗一覧</h3> {{-- タイトルを店舗一覧に変更 --}}

                    {{-- レストランリストをグリッド形式（画像重視）で表示 --}}
                    {{-- ここもカラム数を調整。親の2/3幅の中でさらにグリッドを組む --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> 
                        @forelse ($restaurants as $restaurant)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                                <a href="{{ route('restaurants.show', $restaurant) }}">
                                    @if ($restaurant->image_url)
                                        <img src="{{ asset($restaurant->image_url) }}" alt="{{ $restaurant->name }}" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">画像なし</div>
                                    @endif
                                    <div class="p-3">
                                        <h4 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors duration-200">{{ $restaurant->name }}</h4>
                                        <div class="flex items-center text-sm text-gray-600 mt-1">
                                            @if (isset($restaurant->reviews_avg_rating))
                                                <span class="text-yellow-500 mr-1">★</span> {{ number_format($restaurant->reviews_avg_rating, 1) }} ({{ $restaurant->reviews_count ?? 0 }})
                                            @else
                                                評価なし
                                            @endif
                                        </div>
                                        <p class="text-gray-500 text-xs mt-1 line-clamp-1">{{ $restaurant->address }}</p>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-600 col-span-full">お探しの条件に合う焼肉店は見つかりませんでした。</p>
                        @endforelse
                    </div>
                    
                    {{-- ページネーションリンク --}}
                    {{-- <div class="mt-8">
                        {{ $restaurants->links() }}
                    </div> --}}
                </div> {{-- md:col-span-2 の div 閉じタグ --}}
            </div> {{-- grid grid-cols-3 の div 閉じタグ --}}
        </div>
    </div>
</x-app-layout>