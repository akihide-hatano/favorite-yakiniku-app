<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }} のレビュー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6 text-center">{{ $restaurant->name }} のレビュー</h1>

                    {{-- 成功メッセージの表示 --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        {{-- 店舗詳細ページに戻るリンク --}}
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="text-blue-600 hover:underline">
                            &larr; {{ $restaurant->name }} の詳細に戻る
                        </a>
                    </div>

                    {{-- 平均評価の表示（オプション） --}}
                    @php
                        // ReviewController@index で with('reviews') を使っていないため、
                        // $restaurant->reviews は遅延ロードされるか、別途計算が必要です。
                        // 正確な平均を出すには、ReviewController で $restaurant->loadAvg('reviews', 'rating') などで
                        // 平均評価を事前にロードしておくか、全レビューを取得して計算する必要があります。
                        // ここでは、現在ページに表示されているレビューの平均を簡易的に計算します。
                        $averageRating = $reviews->avg('rating');
                    @endphp
                    @if ($reviews->isNotEmpty()) {{-- レビューが1件以上ある場合のみ表示 --}}
                        <p class="mb-4 text-lg font-semibold">
                            平均評価: {{ number_format($averageRating, 1) }} / 5 
                            @for ($i = 0; $i < round($averageRating); $i++) ★ @endfor
                            @for ($i = 0; $i < (5 - round($averageRating)); $i++) ☆ @endfor
                        </p>
                    @else
                        <p class="mb-4 text-gray-600">まだレビューがありません。</p>
                    @endif


                    {{-- レビュー投稿フォームへのリンク（オプション：必要であれば） --}}
                    {{-- 通常は店舗詳細ページで直接投稿フォームを表示するため、ここは不要なことが多いです --}}
                    {{-- 必要であれば、ここに投稿フォームへのリンクや直接フォームを設置します --}}
                    {{-- <div class="mt-4 mb-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-xl font-bold mb-4">レビューを投稿する</h3>
                        @auth
                            <a href="{{ route('restaurants.reviews.create', $restaurant) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                レビューを投稿する
                            </a>
                        @else
                            <p class="text-gray-600">レビューを投稿するには<a href="{{ route('login') }}" class="text-blue-500 hover:underline">ログイン</a>してください。</p>
                        @endauth
                    </div> --}}

                    {{-- 既存レビューの表示 --}}
                    @forelse ($reviews as $review)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                            <p class="font-semibold text-lg">{{ $review->user->name ?? '匿名ユーザー' }} さん</p> {{-- user リレーションから名前を取得 --}}
                            <p class="text-yellow-500">
                                @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
                                @for ($i = 0; $i < (5 - $review->rating); $i++) ☆ @endfor {{-- 空の星 --}}
                            </p>
                            <p class="text-gray-800 mt-1">{{ $review->comment }}</p> {{-- comment を表示 --}}
                            <p class="text-gray-500 text-sm mt-1">
                                投稿日: {{ $review->created_at->format('Y/m/d H:i') }}
                                @auth
                                    {{-- 編集ボタン（自分のレビューのみ） --}}
                                    @if(Auth::id() == $review->user_id)
                                        <a href="{{ route('restaurants.reviews.edit', [$restaurant, $review]) }}" class="text-blue-500 hover:text-blue-700 text-xs ml-4">編集</a>
                                        {{-- 削除ボタン（自分のレビューのみ） --}}
                                        <form action="{{ route('restaurants.reviews.destroy', [$restaurant, $review]) }}" method="POST" onsubmit="return confirm('本当にこのレビューを削除してもよろしいですか？');" class="inline-block ml-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs">削除</button>
                                        </form>
                                    @endif
                                @endauth
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-600">まだレビューがありません。</p>
                    @endforelse

                    {{-- ページネーションリンク --}}
                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>