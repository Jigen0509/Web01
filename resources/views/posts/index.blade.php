<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>冒険の記録帳 - 和白干潟探検</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans JP', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #60a5fa 75%, #93c5fd 100%);
            background-size: cover;
            background-position: center;
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }

        /* 波のアニメーション */
        .wave {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 150px;
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.3), rgba(5, 150, 105, 0.3));
            border-radius: 1000px 1000px 0 0;
            animation: wave-move 10s ease-in-out infinite;
            z-index: 0;
            pointer-events: none;
        }

        .wave:nth-child(2) {
            bottom: -10px;
            opacity: 0.5;
            animation: wave-move 8s ease-in-out infinite reverse;
        }

        .wave:nth-child(3) {
            bottom: -20px;
            opacity: 0.3;
            animation: wave-move 6s ease-in-out infinite;
        }

        @keyframes wave-move {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(-50%);
            }
        }

        /* キラキラエフェクト */
        .sparkle {
            position: fixed;
            width: 3px;
            height: 3px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
            animation: sparkle-twinkle 3s ease-in-out infinite;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes sparkle-twinkle {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1.5);
            }
        }

        /* ホタルエフェクト */
        .firefly {
            position: fixed;
            width: 4px;
            height: 4px;
            background: #fbbf24;
            border-radius: 50%;
            box-shadow: 0 0 10px #fbbf24;
            animation: float-firefly 8s ease-in-out infinite;
            opacity: 0;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes float-firefly {
            0%, 100% {
                opacity: 0;
                transform: translateY(0) translateX(0) rotate(0deg);
            }
            10%, 90% {
                opacity: 1;
            }
            50% {
                transform: translateY(-50px) translateX(25px) rotate(180deg);
            }
            100% {
                transform: translateY(-100px) translateX(50px) rotate(360deg);
            }
        }

        /* 浮遊する泡 */
        .bubble {
            position: fixed;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.8), rgba(134, 239, 172, 0.3));
            border-radius: 50%;
            animation: bubble-rise 15s ease-in infinite;
            z-index: 0;
            pointer-events: none;
            opacity: 0.6;
        }

        @keyframes bubble-rise {
            0% {
                bottom: -100px;
                opacity: 0;
                transform: translateX(0) scale(1);
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                bottom: 110%;
                opacity: 0;
                transform: translateX(100px) scale(1.2);
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 2;
        }

        /* ヘッダー */
        .header {
            text-align: center;
            margin-bottom: 50px;
        }

        .header h1 {
            font-size: 56px;
            font-weight: 900;
            color: #ffffff;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
            margin-bottom: 15px;
            letter-spacing: 0.05em;
        }

        .header p {
            font-size: 22px;
            font-weight: 700;
            color: #fbbf24;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
        }

        /* 新規投稿ボタン */
        .create-btn-wrapper {
            text-align: center;
            margin-bottom: 50px;
        }

        .create-btn {
            display: inline-block;
            background: rgba(16, 185, 129, 0.6);
            backdrop-filter: blur(15px);
            color: #ffffff;
            font-size: 24px;
            font-weight: 900;
            padding: 20px 50px;
            border: 3px solid rgba(134, 239, 172, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
            letter-spacing: 0.05em;
        }

        .create-btn:hover {
            background: rgba(16, 185, 129, 0.8);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        }

        /* 空の状態 */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-card {
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(15px);
            padding: 60px 40px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 3px dashed rgba(134, 239, 172, 0.5);
        }

        .empty-card .icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .empty-card h3 {
            font-size: 32px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 15px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
        }

        .empty-card p {
            font-size: 20px;
            font-weight: 700;
            color: #fbbf24;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
        }

        /* 投稿グリッド */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        }

        /* 投稿カード */
        .post-card {
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(15px);
            padding: 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(134, 239, 172, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6);
            border-color: rgba(134, 239, 172, 0.6);
        }

        .post-card::before {
            content: '💎';
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 36px;
            opacity: 0.7;
        }

        .post-card::after {
            content: '🗝️';
            position: absolute;
            bottom: 15px;
            left: 15px;
            font-size: 30px;
            opacity: 0.7;
        }

        /* タイトル */
        .post-title {
            font-size: 26px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
            word-break: break-word;
        }

        .post-title a {
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s ease;
        }

        .post-title a:hover {
            color: #fbbf24;
        }

        /* 日付バッジ */
        .post-date {
            display: inline-block;
            background: rgba(251, 191, 36, 0.9);
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            padding: 10px 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
        }

        /* 投稿内容 */
        .post-content {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid rgba(134, 239, 172, 0.3);
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .post-content p {
            color: #ffffff;
            font-size: 16px;
            line-height: 1.8;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
        }

        /* 続きを読むボタン */
        .read-more {
            display: inline-block;
            background: rgba(16, 185, 129, 0.6);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            padding: 12px 30px;
            border: 2px solid rgba(134, 239, 172, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
        }

        .read-more:hover {
            background: rgba(16, 185, 129, 0.8);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }

        /* ナビゲーションボタン */
        .nav-buttons {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            display: flex;
            gap: 10px;
        }

        .nav-button {
            display: inline-block;
            background: rgba(16, 185, 129, 0.6);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            padding: 12px 30px;
            border: 2px solid rgba(134, 239, 172, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .nav-button:hover {
            background: rgba(16, 185, 129, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        /* フッター */
        .footer {
            text-align: center;
            padding: 40px 20px;
        }

        .footer-message {
            background: rgba(16, 185, 129, 0.25);
            backdrop-filter: blur(15px);
            display: inline-block;
            padding: 25px 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(134, 239, 172, 0.4);
        }

        .footer-message p {
            font-size: 20px;
            font-weight: 900;
            color: #fbbf24;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.8);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .posts-grid {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .header h1 {
                font-size: 36px;
            }

            .header p {
                font-size: 18px;
            }

            .create-btn {
                font-size: 18px;
                padding: 15px 30px;
            }

            .post-card {
                padding: 25px;
            }

            .post-title {
                font-size: 22px;
            }

            .post-date {
                font-size: 14px;
                padding: 8px 16px;
            }

            .read-more {
                font-size: 14px;
                padding: 10px 24px;
            }

            .empty-card {
                padding: 40px 25px;
            }

            .empty-card h3 {
                font-size: 24px;
            }

            .empty-card p {
                font-size: 16px;
            }

            .footer-message {
                padding: 20px 30px;
            }

            .footer-message p {
                font-size: 16px;
            }

            /* ナビゲーションボタンのスマホ調整 */
            .nav-buttons {
                flex-direction: column;
                top: 15px;
                left: 15px;
            }
            
            .nav-button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 28px;
            }

            .header p {
                font-size: 16px;
            }

            .create-btn {
                font-size: 16px;
                padding: 12px 25px;
            }

            .post-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- 波のアニメーション -->
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>

    <!-- キラキラエフェクト -->
    @for($i = 0; $i < 30; $i++)
        <div class="sparkle" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 30) / 10 }}s;">
        </div>
    @endfor

    <!-- ホタルエフェクト -->
    @for($i = 0; $i < 20; $i++)
        <div class="firefly" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;">
        </div>
    @endfor

    <!-- 浮遊する泡 -->
    @for($i = 0; $i < 15; $i++)
        <div class="bubble" style="left: {{ rand(0, 100) }}%; width: {{ rand(20, 60) }}px; height: {{ rand(20, 60) }}px; animation-delay: {{ rand(0, 15) }}s;">
        </div>
    @endfor

        <!-- ナビゲーションボタン -->
        <div class="nav-buttons">
            <a href="{{ route('user-point-status.index') }}" class="nav-button">
                📊 ステータス
            </a>
            <a href="{{ route('points.index') }}" class="nav-button">
                🗺️ ポイント一覧
            </a>
        </div>

        <div class="container">
            <!-- ヘッダー -->
            <div class="header">
                <h1>🗺️ 冒険の記録帳 🗺️</h1>
                <p>みんなの素晴らしい冒険を見てみよう!</p>
            </div>

            <!-- 新規投稿ボタン -->
            <div class="create-btn-wrapper">
                <a href="{{ route('posts.create') }}" class="create-btn">
                    ✏️ 新しい冒険を記録する ⭐
                </a>
            </div>

            @if($posts->isEmpty())
            <!-- 投稿がない場合 -->
            <div class="empty-state">
                <div class="empty-card">
                    <div class="icon">🏴‍☠️</div>
                    <h3>まだ冒険の記録がないよ!</h3>
                    <p>君が最初の冒険者になろう!</p>
                </div>
            </div>
            @else
            <!-- 投稿一覧 -->
            <div class="posts-grid">
                @foreach($posts as $post)
                <div class="post-card">
                    <!-- タイトル -->
                    <h2 class="post-title">
                        <a href="{{ route('posts.show', $post) }}">
                            🏴‍☠️ {{ $post->title }}
                        </a>
                    </h2>

                    <!-- 日付 -->
                    <div class="post-date">
                        🧭 {{ $post->created_at->format('Y年m月d日') }}の冒険
                    </div>

                    <!-- 内容 -->
                    <div class="post-content">
                        <p>📖 {{ Str::limit($post->body, 80) }}</p>
                    </div>

                    <!-- 続きを読むボタン -->
                    <a href="{{ route('posts.show', $post) }}" class="read-more">
                        続きを読む 👀
                    </a>
                </div>
                @endforeach
            </div>
            @endif

            <!-- フッター -->
            <div class="footer">
                <div class="footer-message">
                    <p>🌟 すべての冒険には価値がある!君の物語を聞かせて! 🌟</p>
                </div>
            </div>
        </div>
</body>

</html>