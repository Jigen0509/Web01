<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>謎解きチャレンジ一覧 - 和白エクスプローラー</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-3xl font-bold mb-6">🎯 謎解きチャレンジ</h1>
                        
                        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                            <p class="text-blue-700">
                                各探索ポイントには謎解きチャレンジが用意されています。<br>
                                ポイント詳細ページから「謎解きに挑戦する」ボタンをクリックしてチャレンジしてください!
                            </p>
                        </div>

                        <div class="text-center py-8">
                            <a href="{{ route('points.index') }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                                📍 探索ポイント一覧へ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
