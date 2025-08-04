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

                    {{-- 平均評価の表示 --}}
                    @if ($averageRating !== null && $averageRating > 0)
                        <p class="mb-4 text-xl font-semibold">
                            平均評価: {{ number_format($averageRating, 1) }} / 5
                            @for ($i = 0; $i < round($averageRating); $i++) ★ @endfor
                            @for ($i = 0; $i < (5 - round($averageRating)); $i++) ☆ @endfor
                        </p>
                    @else
                        <p class="mb-4 text-gray-600">まだレビューがありません。</p>
                    @endif

                    {{-- 既存レビューの表示 --}}
                    @forelse ($reviews as $review)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                            <p class="font-semibold text-lg">{{ $review->user->name ?? '匿名ユーザー' }} さん</p>
                            <p class="text-yellow-500">
                                @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
                                @for ($i = 0; $i < (5 - $review->rating); $i++) ☆ @endfor
                            </p>
                            <p class="text-gray-800 mt-1">{{ $review->comment }}</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <p class="text-gray-500 text-sm">
                                    投稿日: {{ $review->created_at->format('Y/m/d H:i') }}
                                </p>
                                @auth
                                    @if(Auth::id() == $review->user_id)
                                        <a href="{{ route('restaurants.reviews.edit', [$restaurant, $review]) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded transition-colors duration-200">
                                            編集
                                        </a>
                                        <form action="{{ route('restaurants.reviews.destroy', [$restaurant, $review]) }}" method="POST" onsubmit="return confirm('本当にこのレビューを削除してもよろしいですか？');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-2 rounded transition-colors duration-200">
                                                削除
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
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