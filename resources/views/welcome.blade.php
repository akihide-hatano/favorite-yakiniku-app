<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>京都焼肉アプリ</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-orange-300 min-h-screen">
        <div class="flex flex-col items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl p-8 max-w-4xl mx-auto flex flex-col lg:flex-row items-center gap-8">
                {{-- 画像を左側に配置 --}}
                <div class="lg:w-1/2">
                    <img src="{{ asset('images/yakiniku-main.png') }}" alt="美味しそうな焼肉の写真" class="rounded-lg shadow-md w-full max-w-md mx-auto">
                </div>

                {{-- テキストとボタンを右側に配置 --}}
                <div class="lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left">
                    <h1 class="text-4xl font-bold mb-4 text-gray-800">京都でおすすめの焼肉屋を<br>みんなで作ろう</h1>
                    <p class="text-lg text-gray-600 mb-8">
                        このアプリは、京都の美味しい焼肉店を探したり、お気に入りのお店を共有したりできるコミュニティサイトです。<br class="hidden md:block">
                        新しいお店を発見したり、他のユーザーのレビューを参考にしたりして、最高の焼肉体験を見つけましょう！
                    </p>

                    {{-- ログインしているかどうかに応じてボタンを切り替える --}}
                    @auth
                        {{-- ログイン済みの場合は、アプリの主要機能へのリンクを表示 --}}
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('restaurants.index') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">
                                焼肉店を探索する
                            </a>
                            <a href="{{ route('restaurants.create') }}" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">
                                新しいお店を登録する
                            </a>
                        </div>
                    @else
                        {{-- ゲスト（未ログイン）の場合は、ログインと登録のボタンを表示 --}}
                        <div class="flex flex-col md:flex-row gap-4">
                            <a href="{{ route('login') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-300">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>