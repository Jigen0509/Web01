<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                z-index: -1;
            }

            @keyframes twinkle {
                0%, 100% {
                    opacity: 0;
                    transform: scale(0.5);
                }
                50% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .firefly {
                position: absolute;
                width: 3px;
                height: 3px;
                background: rgba(134, 239, 172, 0.9);
                border-radius: 50%;
                box-shadow: 0 0 8px 2px rgba(134, 239, 172, 0.8);
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

            @keyframes lightRay {
                0%, 100% {
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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full">
        <!-- 背景動画 -->
        <video autoplay muted loop playsinline>
            <source src="{{ secure_asset('image/画像を動かしドラゴンを追加.mp4') }}" type="video/mp4">
        </video>

        <div class="explorer-container">
            <!-- 背景の装飾要素 -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
                <!-- 光の筋 -->
                <div class="light-ray" style="left: 15%; animation-delay: 0s;"></div>
                <div class="light-ray" style="left: 35%; animation-delay: 2s;"></div>
                <div class="light-ray" style="left: 55%; animation-delay: 4s;"></div>
                <div class="light-ray" style="left: 75%; animation-delay: 6s;"></div>

                <!-- 霧のエフェクト -->
                <div class="fog" style="bottom: 0; animation-delay: 0s;"></div>
                <div class="fog" style="bottom: 200px; animation-delay: 10s;"></div>
            </div>

            <!-- メインコンテンツ -->
            <div class="w-full max-w-md relative z-10">
                <div class="bg-white/95 backdrop-blur-md p-8 shadow-xl" style="border: 2px solid rgba(134, 239, 172, 0.3);">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            // ホタルのアニメーション生成
            function createFireflies() {
                const container = document.querySelector('.explorer-container');
                const fireflyCount = 30;

                for (let i = 0; i < fireflyCount; i++) {
                    const firefly = document.createElement('div');
                    firefly.className = 'firefly';

                    const size = Math.random() * 3 + 2;
                    firefly.style.width = size + 'px';
                    firefly.style.height = size + 'px';

                    firefly.style.left = Math.random() * 100 + '%';
                    firefly.style.top = Math.random() * 100 + '%';

                    firefly.style.animationDelay = Math.random() * 2 + 's';
                    firefly.style.animationDuration = (Math.random() * 2 + 1.5) + 's';

                    container.appendChild(firefly);
                }
            }

            createFireflies();
        </script>
    </body>
</html>
