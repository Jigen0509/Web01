<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $point->name }} - 和白探検隊</title>
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

        .tag-navigation {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 15px;
            z-index: 50;
            flex-wrap: nowrap;
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
            min-height: 100vh;
            padding: 100px 20px 40px;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 48px;
            font-weight: 900;
            color: #86efac;
            text-shadow: 0 0 20px rgba(134, 239, 172, 0.5);
            letter-spacing: 0.1em;
            margin-bottom: 10px;
        }

        .page-subtitle {
            font-size: 18px;
            font-weight: 700;
            color: #a7f3d0;
            letter-spacing: 0.05em;
        }

        .info-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.4);
        }

        .info-title {
            font-size: 24px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .description-box {
            background: rgba(167, 243, 208, 0.25);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(16, 185, 129, 0.4);
            border-left: 5px solid #10b981;
            padding: 20px;
            font-size: 16px;
            line-height: 1.8;
            color: #ffffff;
            margin-bottom: 30px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .image-container {
            position: relative;
            margin-top: 20px;
        }

        .point-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border: 3px solid #10b981;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .point-image:hover {
            transform: scale(1.02);
        }

        .no-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, rgba(167, 243, 208, 0.3), rgba(16, 185, 129, 0.2));
            border: 3px solid #10b981;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #059669;
            font-weight: 700;
        }

        .quiz-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.5);
        }

        .quiz-title {
            font-size: 28px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .quiz-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: linear-gradient(145deg, #10b981, #059669);
            color: #ffffff;
            font-weight: 700;
            font-size: 18px;
            border: 2px solid rgba(134, 239, 172, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .quiz-button:hover {
            background: linear-gradient(145deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.6);
        }

        .no-quiz {
            text-align: center;
            padding: 40px;
            background: rgba(167, 243, 208, 0.2);
            border: 2px dashed #10b981;
            color: #059669;
            font-weight: 700;
        }

        .posts-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.5);
        }

        .posts-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .posts-title {
            font-size: 28px;
            font-weight: 900;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .create-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(145deg, #10b981, #059669);
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            border: 2px solid rgba(134, 239, 172, 0.5);
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
        }

        .create-button:hover {
            background: linear-gradient(145deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .post-item {
            background: rgba(167, 243, 208, 0.25);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(16, 185, 129, 0.4);
            border-left: 5px solid #10b981;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .post-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
            background: rgba(167, 243, 208, 0.35);
        }

        .post-title {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 10px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .post-body {
            font-size: 14px;
            color: #ffffff;
            margin-bottom: 15px;
            line-height: 1.6;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        }

        .post-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #10b981;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .post-link:hover {
            color: #059669;
        }

        .no-posts {
            text-align: center;
            padding: 40px;
            background: rgba(167, 243, 208, 0.2);
            border: 2px dashed #10b981;
        }

        .no-posts-text {
            font-size: 18px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 20px;
        }

        .nav-buttons {
            text-align: center;
            margin-top: 40px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: rgba(75, 85, 99, 0.9);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
            border: 2px solid rgba(156, 163, 175, 0.5);
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .back-button:hover {
            background: rgba(55, 65, 81, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            .tag-navigation {
                top: 10px;
                gap: 4px;
                max-width: 100%;
                padding: 0 5px;
            }

            .nav-tag {
                padding: 6px 10px;
                font-size: 11px;
                white-space: nowrap;
            }

            .page-title {
                font-size: 32px;
            }

            .info-card,
            .quiz-card,
            .posts-card {
                padding: 20px;
            }

            .point-image,
            .no-image {
                height: 250px;
            }

            .posts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 400px) {
            .tag-navigation {
                gap: 3px;
                padding: 0 3px;
            }

            .nav-tag {
                padding: 5px 8px;
                font-size: 10px;
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

        <nav class="tag-navigation">
            <a href="{{ route('posts.index') }}" class="nav-tag"> 投稿一覧</a>
            <a href="{{ route('user-point-status.index') }}" class="nav-tag"> ステータス</a>
            <a href="{{ route('points.index') }}" class="nav-tag active"> 探索ポイント</a>
        </nav>

        <div class="main-container">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title"> {{ $point->name }}</h1>
                    <p class="page-subtitle"> 探索ポイント詳細</p>
                </div>

                <div class="info-card">
                    <h3 class="info-title"><span></span>探検記録</h3>
                    <div class="description-box">{{ $point->description }}</div>
                    <div class="image-container">
                        @if(!empty($point->image_path))
                        <img src="{{ asset('storage/' . $point->image_path) }}" alt="{{ $point->name }}" class="point-image">
                        @else
                        <div class="no-image">
                            <span style="font-size: 60px; margin-bottom: 15px;">📸</span>
                            <p style="font-size: 20px; margin-bottom: 5px;">写真素材リンク</p>
                            <p style="font-size: 14px; color: #a7f3d0; margin-bottom: 15px;">※著作権フリー素材のリンク集</p>
                            @php
                            $imageLinks = [
                            '和白干潟' => 'https://www.photo-ac.com/main/search?q=和白干潟',
                            '立花山' => 'https://www.photo-ac.com/main/search?q=立花山',
                            '香椎宮' => 'https://www.photo-ac.com/main/search?q=香椎宮',
                            '志賀島' => 'https://www.photo-ac.com/main/detail/25820711',
                            '海の中道海浜公園' => 'https://www.photo-ac.com/main/search?q=海の中道海浜公園',
                            '筥崎宮' => 'https://www.photo-ac.com/main/search?q=筥崎宮',
                            'アイランドシティ中央公園' => 'https://www.crossroadfukuoka.jp/business/photo/1758',
                            '名島城跡' => 'https://www.photo-ac.com/main/search?q=名島門',
                            '三日月山' => 'https://www.photo-ac.com/main/search?q=三日月山',
                            '奈多海岸' => 'https://pixta.jp/tags/奈多海岸 海 海岸 夕日',
                            '三苫海岸' => 'https://pixta.jp/tags/奈多海岸 海 海岸 夕日',
                            ];
                            $link = null;
                            foreach ($imageLinks as $keyword => $url) {
                            if (str_contains($point->name, $keyword)) {
                            $link = $url;
                            break;
                            }
                            }
                            @endphp
                            @if($link)
                            <a href="{{ $link }}" target="_blank" rel="noopener noreferrer"
                                style="display: inline-block; padding: 12px 24px; background: linear-gradient(145deg, #10b981, #059669); 
                                      color: #ffffff; text-decoration: none; font-weight: 700; border: 2px solid rgba(134, 239, 172, 0.5);
                                      transition: all 0.3s ease; font-size: 14px;">
                                🔗 写真素材を見る（写真AC）
                            </a>
                            <p style="font-size: 12px; color: #86efac; margin-top: 10px;">
                                ※個人・商用利用可能（利用規約をご確認ください）
                            </p>
                            @else
                            <p style="font-size: 16px;">画像は後日追加予定</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div class="quiz-card">
                    <h2 class="quiz-title"><span></span>謎解きチャレンジ</h2>
                    @if($point->quizzes->isNotEmpty())
                    <div style="margin-bottom: 20px; padding: 15px; background: rgba(167, 243, 208, 0.2); border-left: 4px solid #10b981;">
                        <p style="color: #059669; font-weight: 700;"> この探索ポイントの謎に挑戦してみよう!</p>
                    </div>
                    <form action="{{ route('quizzes.start') }}" method="POST">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $point->quizzes->first()->id }}">
                        <button type="submit" class="quiz-button">
                            <span style="font-size: 20px;"></span>謎解きに挑戦する<span style="font-size: 20px;"></span>
                        </button>
                    </form>
                    @else
                    <div class="no-quiz">
                        <span style="font-size: 48px; display: block; margin-bottom: 10px;"></span>
                        <p>この探索ポイントの謎はまだ準備中です</p>
                    </div>
                    @endif
                </div>

                <div class="posts-card">
                    <div class="posts-header">
                        <h2 class="posts-title"><span></span>探検日誌</h2>
                        @auth
                        <a href="{{ route('posts.create', ['point_id' => $point->id]) }}" class="create-button"><span></span>探検記録を残す</a>
                        @endauth
                    </div>
                    @if($point->posts->isNotEmpty())
                    <div class="posts-grid">
                        @foreach($point->posts as $post)
                        <div class="post-item">
                            <h3 class="post-title"> {{ $post->title }}</h3>
                            <p class="post-body">{{ $post->body }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="post-link"><span></span>詳細を見る</a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="no-posts">
                        <span style="font-size: 60px; display: block; margin-bottom: 15px;"></span>
                        <p class="no-posts-text">まだ誰も探検記録を残していません</p>
                        @auth
                        <a href="{{ route('posts.create', ['point_id' => $point->id]) }}" class="create-button">
                            <span style="font-size: 20px;"></span>最初の探検記録を残す<span style="font-size: 20px;"></span>
                        </a>
                        @endauth
                        @guest
                        <div style="background: rgba(167, 243, 208, 0.3); border: 2px solid #10b981; padding: 20px; margin-top: 20px; display: inline-block;">
                            <p style="color: #065f46; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                                <span></span>探検記録を残すには冒険者登録（ログイン）が必要です
                            </p>
                        </div>
                        @endguest
                    </div>
                    @endif
                </div>

                <div class="nav-buttons">
                    <a href="{{ route('points.index') }}" class="back-button">
                        <span></span>探索ポイント一覧に戻る<span></span>
                    </a>
                </div>
            </div>
        </div>

</body>

</html>