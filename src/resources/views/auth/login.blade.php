<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Google Fonts - Noto Sans JP -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Noto Sans JP', sans-serif;
        }

        body {
            position: relative;
        }

        body video {
            position: fixed;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            z-index: -2;
            object-fit: cover;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            pointer-events: none;
            z-index: -1;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse at 50% 20%, rgba(134, 239, 172, 0.1) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 60%, rgba(52, 211, 153, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-10px) rotate(1deg);
            }

            66% {
                transform: translateY(5px) rotate(-1deg);
            }
        }

        @keyframes walkLeft {
            0% {
                transform: translateX(100vw);
            }

            100% {
                transform: translateX(-150px);
            }
        }

        @keyframes walkRight {
            0% {
                transform: translateX(-150px);
            }

            100% {
                transform: translateX(100vw);
            }
        }

        .dot {
            position: absolute;
            border-radius: 50%;
            animation: twinkle 2s linear infinite;
        }

        .explorer-container {
            position: relative;
            min-height: 100vh;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            overflow: hidden;
        }

        .form-input {
            transition: all 0.2s ease;
        }

        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        @keyframes dropBounce {
            0% {
                transform: translateY(-200px);
                opacity: 0;
            }

            40% {
                opacity: 1;
            }

            70% {
                transform: translateY(0px);
            }

            80% {
                transform: translateY(-15px);
            }

            90% {
                transform: translateY(0px);
            }

            95% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
                opacity: 1;
            }
        }

        .title-char {
            display: inline-block;
            animation: dropBounce 1.8s ease-out forwards;
            opacity: 0;
        }

        .title-char:nth-child(1) {
            animation-delay: 0.2s;
        }

        .title-char:nth-child(2) {
            animation-delay: 0.5s;
        }

        .title-char:nth-child(3) {
            animation-delay: 0.8s;
        }

        .title-char:nth-child(4) {
            animation-delay: 1.1s;
        }

        .title-char:nth-child(5) {
            animation-delay: 1.4s;
        }

        @keyframes lightRay {

            0%,
            100% {
                opacity: 0.1;
                transform: translateY(0) scaleY(1);
            }

            50% {
                opacity: 0.3;
                transform: translateY(-20px) scaleY(1.1);
            }
        }

        .light-ray {
            position: absolute;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom,
                    transparent 0%,
                    rgba(134, 239, 172, 0.3) 20%,
                    rgba(134, 239, 172, 0.5) 50%,
                    rgba(134, 239, 172, 0.3) 80%,
                    transparent 100%);
            animation: lightRay 8s ease-in-out infinite;
            filter: blur(1px);
        }

        @keyframes fogMove {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            10% {
                opacity: 0.3;
            }

            90% {
                opacity: 0.3;
            }

            100% {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .fog {
            position: absolute;
            width: 200%;
            height: 200px;
            background: radial-gradient(ellipse at center, rgba(167, 243, 208, 0.2) 0%, transparent 70%);
            animation: fogMove 20s ease-in-out infinite;
            filter: blur(20px);
        }
    </style>
</head>

<body class="h-full">
    <!-- 背景動画 -->
    <video autoplay muted loop playsinline>
        <source src="{{ asset('image/画像を動かしドラゴンを追加.mp4') }}" type="video/mp4">
    </video>

    <div class="explorer-container">
        <!-- 背景の装飾要素 -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <!-- 光の筋 -->
            <div class="light-ray" style="left: 15%; animation-delay: 0s;"></div>
            <div class="light-ray" style="left: 35%; animation-delay: 2s;"></div>
            <div class="light-ray" style="left: 55%; animation-delay: 4s;"></div>
            <div class="light-ray" style="left: 75%; animation-delay: 6s;"></div>
            <div class="light-ray" style="left: 90%; animation-delay: 1s;"></div>

            <!-- 霧のエフェクト -->
            <div class="fog" style="bottom: 0; animation-delay: 0s;"></div>
            <div class="fog" style="bottom: 20%; animation-delay: 8s;"></div>
            <div class="fog" style="bottom: 40%; animation-delay: 14s;"></div>

            <!-- キラキラするドット（JavaScriptで追加） -->
        </div>

        <!-- Main Container -->
        <div class="w-full max-w-md z-30 relative">
            <!-- ヘッダー -->
            <div class="text-center mb-8">
                <h1 class="text-6xl font-black mb-2" style="font-family: 'Noto Sans JP', sans-serif; color: #86efac; text-shadow: 0 0 20px rgba(134, 239, 172, 0.5), 0 4px 6px rgba(0, 0, 0, 0.5);">
                    <span class="title-char">和</span><span class="title-char">白</span><span class="title-char">探</span><span class="title-char">検</span><span class="title-char">隊</span>
                </h1>
                <p class="text-lg font-medium mb-8" style="color: #a7f3d0; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                    森の冒険へようこそ
                </p>

                <!-- 冒険を始めるボタン -->
                <button
                    id="startAdventureBtn"
                    class="px-8 py-4 text-xl font-bold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-110 shadow-2xl border-2 border-green-300"
                    style="letter-spacing: 0.1em; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                    🌲 冒険を始める 🌲
                </button>
            </div>

            <!-- Session Status -->
            @if (session('status'))
            <div class="mb-6 p-4 bg-green-100 border-2 border-green-300 text-green-800">
                <span class="font-medium" style="letter-spacing: 0.05em;">{{ session('status') }}</span>
            </div>
            @endif

            <!-- ログインカード（初期非表示） -->
            <div id="loginCard" class="hidden bg-white/95 backdrop-blur-md p-8 shadow-xl" style="border: 2px solid rgba(134, 239, 172, 0.3);">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center" style="letter-spacing: 0.05em;">ログイン</h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                            メールアドレス
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                            placeholder="your@example.com" />
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2" style="letter-spacing: 0.05em;">
                            パスワード
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="form-input block w-full px-4 py-3 text-base border-2 border-gray-300 bg-white focus:outline-none focus:border-green-500 transition-all"
                            placeholder="パスワードを入力" />
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 text-base font-semibold text-white bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-md" style="letter-spacing: 0.1em;">
                        ログイン
                    </button>

                    <!-- Links -->
                    <div class="space-y-3 pt-2">
                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-green-600 transition-colors" style="letter-spacing: 0.05em;">
                                パスワードをお忘れの方
                            </a>
                        </div>
                        @endif

                        @if (Route::has('register'))
                        <div class="text-center pt-4 border-t border-gray-300">
                            <p class="text-sm text-gray-600 mb-2" style="letter-spacing: 0.05em;">
                                アカウントをお持ちでない方
                            </p>
                            <a href="{{ route('register') }}" class="inline-block px-6 py-2 text-sm font-medium text-green-600 hover:text-green-700 border-2 border-green-600 hover:bg-green-50 transition-all" style="letter-spacing: 0.05em;">
                                新規登録
                            </a>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // 森の雰囲気を作るドットとパーティクル
        function createForestElements() {
            const container = document.querySelector('.explorer-container');
            const colors = ['#86efac', '#6ee7b7', '#5eead4', '#7dd3fc', '#a5f3fc'];

            // キラキラするドット（ホタルのような光）
            for (let i = 0; i < 40; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                dot.style.width = Math.random() * 4 + 2 + 'px';
                dot.style.height = dot.style.width;
                dot.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                dot.style.boxShadow = `0 0 ${Math.random() * 10 + 5}px ${colors[Math.floor(Math.random() * colors.length)]}`;
                dot.style.left = Math.random() * 100 + '%';
                dot.style.top = Math.random() * 100 + '%';
                dot.style.animationDelay = Math.random() * 2 + 's';
                dot.style.animationDuration = (Math.random() * 3 + 2) + 's';
                dot.style.zIndex = '1';
                dot.style.position = 'absolute';
                container.appendChild(dot);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createForestElements();

            // 冒険を始めるボタンのイベントリスナー
            const startBtn = document.getElementById('startAdventureBtn');
            const loginCard = document.getElementById('loginCard');

            if (startBtn && loginCard) {
                startBtn.addEventListener('click', function() {
                    // ボタンをフェードアウト
                    startBtn.style.transition = 'all 0.5s ease-out';
                    startBtn.style.opacity = '0';
                    startBtn.style.transform = 'scale(0.8)';

                    setTimeout(() => {
                        startBtn.style.display = 'none';

                        // ログインカードを表示
                        loginCard.classList.remove('hidden');
                        loginCard.style.opacity = '0';
                        loginCard.style.transform = 'translateY(20px)';

                        setTimeout(() => {
                            loginCard.style.transition = 'all 0.6s ease-out';
                            loginCard.style.opacity = '1';
                            loginCard.style.transform = 'translateY(0)';
                        }, 50);
                    }, 500);
                });
            }
        });
    </script>
</body>

</html>