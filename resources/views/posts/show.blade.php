<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - 和白探検隊</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
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

        .container {
            max-width: 900px;
            margin: 80px auto 40px;
            padding: 0 20px;
        }

        .post-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .post-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #10b981;
        }

        .post-title {
            font-size: 36px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post-meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .meta-item {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .post-body {
            font-size: 18px;
            line-height: 1.8;
            color: #374151;
            margin-bottom: 30px;
            padding: 30px;
            background: rgba(16, 185, 129, 0.05);
            border-radius: 15px;
            white-space: pre-line;
        }

        .post-point {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .post-point a {
            color: #fbbf24;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .post-point a:hover {
            color: #fcd34d;
            text-decoration: underline;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-back {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563, #374151);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* ホタルアニメーション */
        .firefly {
            position: fixed;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
            animation: float 8s infinite ease-in-out;
            z-index: 1;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10%, 90% {
                opacity: 1;
            }
            50% {
                transform: translateY(-100vh) translateX(50px);
            }
        }

        @media (max-width: 768px) {
            .nav-buttons {
                flex-direction: column;
                top: 15px;
                left: 15px;
            }

            .nav-button {
                font-size: 14px;
                padding: 8px 16px;
            }

            .container {
                margin-top: 140px;
            }

            .post-title {
                font-size: 28px;
            }

            .post-body {
                font-size: 16px;
                padding: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    @for ($i = 0; $i < 30; $i++)
    <div class="firefly" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;">
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
        <div class="post-card">
            <div class="post-header">
                <h1 class="post-title">📖 {{ $post->title }}</h1>
                <div class="post-meta">
                    @if($post->category)
                    <span class="meta-item">🏷️ {{ $post->category }}</span>
                    @endif
                    <span class="meta-item">🗓️ {{ $post->created_at->format('Y年m月d日') }}</span>
                    @if($post->user)
                    <span class="meta-item">👤 {{ $post->user->name }}</span>
                    @endif
                </div>
            </div>

            @if(!empty($post->image_path))
            <div style="margin-bottom: 30px;">
                <img src="{{ asset('storage/' . $post->image_path) }}"
                     alt="{{ $post->title }}"
                     style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            </div>
            @endif

            <div class="post-body">
                {{ $post->body }}
            </div>

            @if($post->point)
            <div class="post-point">
                <p style="font-size: 18px; margin: 0;">
                    <span style="font-weight: 600;">🗺️ 探検した場所：</span>
                    <a href="{{ route('points.show', $post->point->id) }}">
                        📍 {{ $post->point->name }}
                    </a>
                </p>
            </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('posts.index') }}" class="btn btn-back">
                    🔙 投稿一覧に戻る
                </a>
                @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-edit">
                    ✏️ 編集する
                </a>
                @endcan
            </div>
        </div>
    </div>
</body>

</html>