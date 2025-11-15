<x-app-layout>
    <div class="min-h-screen" style="background: linear-gradient(135deg, #87CEEB 0%, #98FB98 50%, #F0E68C 100%);">
        <div class="mx-auto w-[900px] px-4 py-8">

            {{-- ページトップの装飾 --}}
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold text-amber-800 mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    📖 冒険の記録を読もう！ 🗺️
                </h1>
            </div>

            {{-- 冒険記録カード --}}
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 shadow-2xl rounded-3xl overflow-hidden
                       border-4 border-amber-400 relative">
                
                <!-- 装飾アイコン -->
                <div class="absolute top-4 right-4 text-4xl opacity-20">🏴‍☠️</div>
                <div class="absolute bottom-4 left-4 text-3xl opacity-20">🧭</div>
                <div class="absolute top-1/4 right-8 text-2xl opacity-20">⭐</div>
                <div class="absolute bottom-1/4 left-8 text-2xl opacity-20">💎</div>

                {{-- メタ情報:カテゴリと投稿日時 --}}
                <div class="flex items-center justify-between p-6 bg-gradient-to-r from-amber-100 to-yellow-100 border-b-3 border-amber-300">
                    <div class="flex items-center gap-3">
                        <span class="inline-block bg-gradient-to-r from-blue-400 to-purple-500 text-white text-lg font-bold px-6 py-2 rounded-full shadow-lg">
                            🏷️ {{ $post->category }}
                        </span>
                    </div>
                    <div class="bg-white rounded-full px-4 py-2 shadow-md border-2 border-amber-300">
                        <span class="text-amber-800 text-lg font-bold flex items-center gap-2">
                            🗓️ {{ $post->created_at->format('Y年m月d日') }}の冒険
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    {{-- 投稿タイトル --}}
                    <div class="text-center mb-8">
                        <div class="bg-gradient-to-r from-red-400 to-pink-400 text-white rounded-2xl p-6 shadow-xl border-3 border-red-300">
                            <h2 class="text-4xl font-bold leading-tight" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                                🌟 {{ $post->title }} 🌟
                            </h2>
                        </div>
                    </div>

                    {{-- 画像表示 --}}
                    @if(!empty($post->image_path))
                    <div class="mb-8">
                        <div class="bg-white p-4 rounded-2xl shadow-xl border-3 border-amber-300">
                            <div class="text-center mb-3">
                                <span class="bg-green-500 text-white px-4 py-2 rounded-full font-bold text-lg">
                                    📸 冒険の写真
                                </span>
                            </div>
                            <img src="{{ asset('storage/') . $post->image_path}}"
                                alt="{{ $post->title }}"
                                class="w-full h-80 object-cover rounded-xl shadow-lg border-2 border-amber-200">
                        </div>
                    </div>
                    @endif

                    {{-- 投稿内容 --}}
                    <div class="mb-8">
                        <div class="bg-white rounded-2xl shadow-xl border-3 border-amber-300 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-400 to-blue-400 text-white p-4">
                                <h3 class="text-2xl font-bold flex items-center gap-2" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                                    📜 冒険のお話
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-6 border-2 border-amber-200 shadow-inner">
                                    <p class="text-gray-800 text-lg leading-relaxed whitespace-pre-line font-medium">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 関連情報 --}}
                    <div class="bg-gradient-to-r from-cyan-100 to-blue-100 rounded-2xl shadow-xl border-3 border-blue-300 overflow-hidden">
                        <div class="bg-gradient-to-r from-cyan-400 to-blue-500 text-white p-4">
                            <h3 class="text-2xl font-bold flex items-center gap-2" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                                🗺️ 冒険の場所
                            </h3>
                        </div>
                        <div class="p-6">
                            {{--関連ポイント--}}
                            @if($post->point)
                            <div class="bg-white rounded-xl p-4 shadow-md border-2 border-blue-200">
                                <p class="text-lg">
                                    <span class="text-blue-800 font-bold">🎯 この冒険をした場所：</span>
                                    <a href="{{ route('points.show',$post->point->id) }}"
                                        class="text-red-600 hover:text-red-800 font-bold text-xl hover:underline 
                                               transform hover:scale-105 inline-block transition-all duration-200">
                                        📍 {{ $post->point->name }}
                                    </a>
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 戻るボタンと編集ボタン --}}
            <div class="flex justify-between items-center mt-8 gap-4">
                <a href="{{ route('posts.index') }}"
                   class="bg-gradient-to-r from-gray-400 to-gray-500 hover:from-gray-500 hover:to-gray-600 
                          text-white font-bold py-4 px-6 rounded-full text-lg transform hover:scale-105 
                          transition-all duration-300 shadow-lg flex items-center gap-2">
                    🔙 冒険一覧に戻る
                </a>
                
                @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}"
                   class="bg-gradient-to-r from-orange-400 to-red-500 hover:from-orange-500 hover:to-red-600 
                          text-white font-bold py-4 px-6 rounded-full text-lg transform hover:scale-105 
                          transition-all duration-300 shadow-lg flex items-center gap-2">
                    ✏️ この冒険を修正する
                </a>
                @endcan
            </div>
            
            <!-- 励ましのメッセージ -->
            <div class="text-center mt-8">
                <div class="bg-white bg-opacity-90 rounded-3xl px-8 py-4 inline-block shadow-lg border-2 border-amber-300">
                    <p class="text-lg text-amber-800 font-bold">
                        🌟 素敵な冒険のお話だったね！君も冒険を記録してみよう！ 🌟
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- 
このデザインの特徴:
1. 📖 「投稿詳細」→「冒険の記録を読もう！」
2. 🎨 宝箱のような大きなカードデザインで冒険記録を表示
3. 🏷️ カテゴリを宝石のようなバッジで表現
4. 📸 画像がある場合は「冒険の写真」として特別に表示
5. 📜 投稿内容を「冒険のお話」として巻物風に表示
6. 🗺️ 関連ポイントを「冒険の場所」として地図風に表示
7. 🌟 各セクションに探検テーマのアイコンと色分け
8. ✏️ 編集ボタンも「冒険を修正する」に変更

デザイン面:
- セクション毎に異なる色のグラデーションで楽しく
- 各ボックスに影と境界線で立体感
- ホバーエフェクトで Interactive な体験
- 背景装飾で探検の雰囲気を演出

機能面:
- 元のLaravelの表示機能を完全に保持
- 画像表示の条件分岐も維持
- ポイントへのリンク機能も保持
- 認可機能(@can)による編集ボタン表示も維持
- 日付フォーマットも維持
--}}