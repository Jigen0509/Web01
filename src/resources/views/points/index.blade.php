<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>和白探索ポイント - 和白探検隊</title>
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
            top: 50%;
            left: 50%;
            width: 110%;
            height: 110%;
            transform: translate(-50%, -50%) scale(1);
            z-index: -2;
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

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            pointer-events: none;
            z-index: -1;
        }

        .firefly {
            position: fixed;
            width: 4px;
            height: 4px;
            background: #86efac;
            border-radius: 50%;
            box-shadow: 0 0 10px #86efac;
            animation: float-firefly 8s ease-in-out infinite;
            opacity: 0;
            z-index: 1;
        }

        @keyframes float-firefly {

            0%,
            100% {
                opacity: 0;
                transform: translateY(0) translateX(0);
            }

            10%,
            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) translateX(50px);
            }
        }

        /* タグ形式のナビゲーション */
        .tag-navigation {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 50;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 90%;
        }

        .nav-tag {
            padding: 12px 24px;
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(134, 239, 172, 0.5);
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .nav-tag:hover {
            background: rgba(16, 185, 129, 0.5);
            border-color: #86efac;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.5);
        }

        .nav-tag.active {
            background: rgba(16, 185, 129, 0.6);
            border-color: #10b981;
        }

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 100px 20px 40px;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 900px;
            width: 100%;
        }

        .page-title {
            font-size: 48px;
            font-weight: 900;
            color: #86efac;
            text-align: center;
            margin-bottom: 40px;
            text-shadow: 0 0 20px rgba(134, 239, 172, 0.5);
            letter-spacing: 0.1em;
            animation: titleGlow 3s ease-in-out infinite;
        }

        @keyframes titleGlow {

            0%,
            100% {
                text-shadow: 0 0 20px rgba(134, 239, 172, 0.5);
            }

            50% {
                text-shadow: 0 0 30px rgba(134, 239, 172, 0.8);
            }
        }

        .points-container {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.4);
        }

        .points-list {
            list-style: none;
            padding: 0;
        }

        .point-item {
            margin: 15px 0;
        }

        .point-link {
            display: flex;
            align-items: center;
            padding: 20px 25px;
            background: rgba(16, 185, 129, 0.25);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(134, 239, 172, 0.5);
            border-left: 5px solid #10b981;
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .point-link:hover {
            background: rgba(16, 185, 129, 0.4);
            border-color: #86efac;
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.5);
        }

        .point-link:hover {
            background: linear-gradient(to right, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
            border-color: #10b981;
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .point-icon {
            font-size: 24px;
            margin-right: 15px;
        }

        .no-points-message {
            font-size: 20px;
            font-weight: 700;
            color: #059669;
            padding: 40px;
            text-align: center;
            background: rgba(167, 243, 208, 0.2);
            border: 2px dashed #10b981;
            letter-spacing: 0.05em;
        }

        @media (max-width: 768px) {
            .tag-navigation {
                top: 10px;
                gap: 8px;
            }

            .nav-tag {
                padding: 10px 16px;
                font-size: 14px;
            }

            .page-title {
                font-size: 32px;
            }

            .points-container {
                padding: 25px;
            }

            .point-link {
                font-size: 16px;
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>

    <!-- 背景動画 -->
    <video autoplay muted loop playsinline>
        <source src="{{ asset('image/Looping_Video_Day_to_Night.mp4') }}" type="video/mp4">
    </video>

    @for ($i = 0; $i < 20; $i++)
        <div class="firefly" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;">
        </div>
        @endfor

        <!-- タグ形式のナビゲーション -->
        <nav class="tag-navigation">
            <a href="{{ route('posts.index') }}" class="nav-tag">📝 投稿一覧</a>
            <a href="{{ route('user-point-status.index') }}" class="nav-tag">⚙️ ステータス</a>
            <a href="{{ route('points.index') }}" class="nav-tag active">📍 探索ポイント</a>
        </nav>

        <div class="main-container">
            <div class="content-wrapper">
                <h1 class="page-title">🌲 和白探索ポイント 🌲</h1>
                <div class="points-container">
                    @if(isset($points) && $points->count() > 0)
                    <ul class="points-list">
                        @foreach($points as $point)
                        @if($point)
                        <li class="point-item">
                            <a href="{{ route('points.show', $point->id) }}" class="point-link">
                                <span class="point-icon"></span>{{ $point->name }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                    <div class="mt-4">{{ $points->links() }}</div>
                    @else
                    <div class="no-points-message">
                        まだ探索ポイントが登録されていません<br>新しい冒険を待っています
                    </div>
                    @endif
                </div>
            </div>
        </div>


</body>

</html>