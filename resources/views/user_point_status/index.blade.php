<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>冒険記録 - 和白探検隊</title>
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
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #60a5fa 75%, #93c5fd 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
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
            flex-wrap: wrap;
            justify-content: center;
            max-width: 90%;
        }

        .logout-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
            padding: 12px 24px;
            background: rgba(239, 68, 68, 0.6);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(248, 113, 113, 0.5);
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .logout-button:hover {
            background: rgba(239, 68, 68, 0.8);
            border-color: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.5);
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

        .page-title {
            font-size: 48px;
            font-weight: 900;
            color: #86efac;
            text-shadow: 0 0 20px rgba(134, 239, 172, 0.5);
            letter-spacing: 0.1em;
            margin-bottom: 10px;
            text-align: center;
        }

        .page-subtitle {
            font-size: 18px;
            font-weight: 700;
            color: #a7f3d0;
            letter-spacing: 0.05em;
            text-align: center;
            margin-bottom: 40px;
        }

        .user-info-card {
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(15px);
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .user-info-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-rank-badge {
            background: linear-gradient(145deg, #fbbf24, #f59e0b);
            color: #ffffff;
            font-size: 24px;
            font-weight: 900;
            padding: 15px 30px;
            border: 3px solid #fef3c7;
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.5);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
            letter-spacing: 0.05em;
        }

        .rank-image {
            width: 180px;
            height: 180px;
            object-fit: contain;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.5));
        }

        .rank-badge-large {
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(245, 158, 11, 0.2));
            border: 3px solid rgba(251, 191, 36, 0.5);
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3);
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.5));
        }

        .user-name {
            font-size: 28px;
            font-weight: 900;
            color: #ffffff;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .user-points {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            color: #fbbf24;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        .summary-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.4);
        }

        .summary-title {
            font-size: 28px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-item {
            background: rgba(167, 243, 208, 0.2);
            backdrop-filter: blur(10px);
            padding: 30px;
            text-align: center;
            border: 2px solid rgba(134, 239, 172, 0.5);
            border-left: 5px solid #10b981;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
            background: rgba(167, 243, 208, 0.3);
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 42px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 10px;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .stat-label {
            font-size: 16px;
            font-weight: 700;
            color: #a7f3d0;
            letter-spacing: 0.05em;
        }

        .records-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.4);
        }

        .records-title {
            font-size: 28px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
        }

        .record-item {
            background: rgba(167, 243, 208, 0.2);
            backdrop-filter: blur(10px);
            padding: 25px;
            margin-bottom: 20px;
            border: 2px solid rgba(134, 239, 172, 0.5);
            border-left: 5px solid #10b981;
            transition: all 0.3s ease;
        }

        .record-item:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
            background: rgba(167, 243, 208, 0.3);
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .record-name {
            font-size: 22px;
            font-weight: 900;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        .record-date {
            font-size: 14px;
            color: #a7f3d0;
            font-weight: 700;
        }

        /* 戻るボタン */
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
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

        .back-button:hover {
            background: rgba(16, 185, 129, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .status-badges {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: 2px solid;
            font-weight: 700;
            font-size: 14px;
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }

        .badge-cleared {
            background: rgba(16, 185, 129, 0.3);
            border-color: #10b981;
            color: #ffffff;
        }

        .badge-not-cleared {
            background: rgba(107, 114, 128, 0.3);
            border-color: #6b7280;
            color: #d1d5db;
        }

        .progress-bar-container {
            background: rgba(0, 0, 0, 0.3);
            height: 20px;
            border: 2px solid rgba(134, 239, 172, 0.3);
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #34d399);
            transition: width 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: 2px solid;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
        }

        .btn-primary {
            background: linear-gradient(145deg, #10b981, #059669);
            color: #ffffff;
            border-color: rgba(134, 239, 172, 0.5);
        }

        .btn-primary:hover {
            background: linear-gradient(145deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: rgba(75, 85, 99, 0.6);
            color: #ffffff;
            border-color: rgba(156, 163, 175, 0.5);
        }

        .btn-secondary:hover {
            background: rgba(55, 65, 81, 0.8);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }

        .missions-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed rgba(134, 239, 172, 0.3);
        }

        .missions-title {
            font-size: 18px;
            font-weight: 900;
            color: #fbbf24;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
            letter-spacing: 0.05em;
        }

        .mission-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
        }

        .mission-card {
            background: rgba(251, 191, 36, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            border: 2px solid rgba(251, 191, 36, 0.5);
            border-left: 5px solid #fbbf24;
            transition: all 0.3s ease;
            position: relative;
        }

        .mission-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
            background: rgba(251, 191, 36, 0.25);
        }

        .mission-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .mission-name {
            font-size: 16px;
            font-weight: 900;
            color: #fef3c7;
            margin-bottom: 8px;
            letter-spacing: 0.05em;
        }

        .mission-status {
            font-size: 14px;
            color: #fcd34d;
            margin-bottom: 12px;
        }

        .mission-status.completed {
            color: #86efac;
        }

        .btn-mission {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(145deg, #fbbf24, #f59e0b);
            color: #ffffff;
            border: 2px solid rgba(254, 243, 199, 0.5);
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
            width: 100%;
            justify-content: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        .btn-mission:hover {
            background: linear-gradient(145deg, #f59e0b, #d97706);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.6);
        }

        .btn-mission.completed {
            background: rgba(75, 85, 99, 0.6);
            border-color: rgba(156, 163, 175, 0.5);
            color: #d1d5db;
            cursor: not-allowed;
        }

        /* 投稿一覧用のスタイル */
        .record-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .record-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .record-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }

        .record-date {
            color: #6b7280;
            font-size: 14px;
        }

        .record-point {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .record-body {
            margin: 0;
            color: #374151;
            line-height: 1.6;
            font-size: 15px;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border: none;
            cursor: pointer;
        }

        .btn-edit:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-delete:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6b7280;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 12px;
            border: 2px dashed rgba(209, 213, 219, 0.5);
        }

        .btn-mission.completed:hover {
            transform: none;
            box-shadow: none;
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
            background: rgba(167, 243, 208, 0.2);
            border: 2px dashed rgba(16, 185, 129, 0.5);
        }

        .empty-icon {
            font-size: 80px;
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 24px;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
        }

        .empty-text {
            font-size: 16px;
            color: #a7f3d0;
            margin-bottom: 25px;
        }

        @media (max-width: 768px) {
            .tag-navigation {
                top: 10px;
                gap: 6px;
                max-width: 95%;
            }

            .nav-tag {
                padding: 8px 12px;
                font-size: 12px;
                white-space: nowrap;
            }

            .logout-button {
                top: 10px;
                right: 10px;
                padding: 10px 16px;
                font-size: 14px;
            }

            .page-title {
                font-size: 32px;
            }

            .summary-card,
            .records-card {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .user-info-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-info-left {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-rank-badge {
                font-size: 20px;
                padding: 12px 24px;
            }

            .user-name {
                font-size: 24px;
            }

            .user-points {
                font-size: 18px;
            }
        }
    </style>
</head>

</style>
</head>

<body>
    <!-- ログアウトボタン -->
    <form method="POST" action="{{ secure_url(route('logout', [], false)) }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout-button">
            🚪 ログアウト
        </button>
    </form>

    <!-- 戻るボタン -->
    <a href="javascript:history.back()" class="back-button">
        ← 戻る
    </a>

    @for ($i = 0; $i < 20; $i++)
        <div class="firefly" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;">
        </div>
        @endfor

        <!-- タグ形式のナビゲーション -->
        <nav class="tag-navigation">
            <a href="{{ route('posts.index') }}" class="nav-tag">📝 投稿一覧</a>
            <a href="{{ route('user-point-status.index') }}" class="nav-tag active">⚙️ ステータス</a>
            <a href="{{ route('points.index') }}" class="nav-tag">📍 探索ポイント</a>
        </nav>

        <div class="main-container">
            <div class="content-wrapper">
                <h1 class="page-title">🏆 君の冒険記録 🏆</h1>
                <p class="page-subtitle">📜 これまでの探検の成果を確認しよう 📜</p>
                <!-- ユーザー情報カード -->
                <div class="user-info-card">
                    <div class="user-info-left">
                        <img src="{{ $rankImage }}" alt="{{ $user->rank }}" class="rank-image">
                        <div>
                            <div class="user-rank-badge">{{ $user->rank }}</div>
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-points">
                                <span>⭐</span>
                                <span>総獲得ポイント: {{ $user->total_point }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="summary-card">
                    <h2 class="summary-title"> 君の冒険の成果 </h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon"></div>
                            <div class="stat-number">{{ $totalVisited }}</div>
                            <div class="stat-label">探索した場所</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon"></div>
                            <div class="stat-number">{{ $totalQuizCleared }}</div>
                            <div class="stat-label">クリアしたクイズ</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon"></div>
                            <div class="stat-number">{{ $totalPosts }}</div>
                            <div class="stat-label">投稿した記録</div>
                        </div>
                    </div>
                </div>

                <div class="records-card">
                    <h2 class="records-title"> 各場所での冒険記録 </h2>

                    @if($userStatuses->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon"></div>
                        <h3 class="empty-title">まだ冒険が始まっていないよ！</h3>
                        <p class="empty-text">最初の冒険に出かけて、記録を残そう！</p>
                        <a href="{{ route('points.index') }}" class="btn btn-primary">
                            冒険の場所を探す
                        </a>
                    </div>
                    @else
                    @foreach($userStatuses as $status)
                    <div class="record-item">
                        <div class="record-header">
                            <h3 class="record-name"> {{ $status->point->name }}</h3>
                            <span class="record-date"> 初回訪問: {{ $status->created_at->format('Y年m月d日') }}</span>
                        </div>

                        <div class="status-badges">
                            @if($status->quiz_cleared)
                            <span class="badge badge-cleared">
                                クイズクリア
                                @if($status->quiz_clear_date)
                                ({{ \Carbon\Carbon::parse($status->quiz_clear_date)->format('n月j日') }})
                                @endif
                            </span>
                            @else
                            <span class="badge badge-not-cleared">
                                クイズ未挑戦
                            </span>
                            @endif

                            @if($status->photo_cleared)
                            <span class="badge badge-cleared">
                                写真投稿済み
                                @if($status->photo_clear_date)
                                ({{ \Carbon\Carbon::parse($status->photo_clear_date)->format('n月j日') }})
                                @endif
                            </span>
                            @else
                            <span class="badge badge-not-cleared">
                                写真未投稿
                            </span>
                            @endif

                            @if($status->quiz_cleared && $status->photo_cleared)
                            <span class="badge badge-cleared" style="background: rgba(251, 191, 36, 0.3); border-color: #fbbf24; color: #fef3c7;">
                                完全制覇！
                            </span>
                            @endif
                        </div>

                        <div class="progress-bar-container">
                            @php
                            $progress = 0;
                            if ($status->quiz_cleared && $status->photo_cleared) {
                            $progress = 100;
                            } elseif ($status->quiz_cleared || $status->photo_cleared) {
                            $progress = 50;
                            }
                            @endphp
                            <div class="progress-bar" style="width: {{ $progress }}%;">
                                {{ $progress }}%
                            </div>
                        </div>

                        {{-- ミッションセクション --}}
                        <div class="missions-section">
                            <h4 class="missions-title">🎯 挑戦できるミッション</h4>
                            <div class="mission-cards">
                                {{-- 謎解きミッション --}}
                                <div class="mission-card">
                                    <div class="mission-icon">🧩</div>
                                    <div class="mission-name">謎解きミッション</div>
                                    <div class="mission-status {{ $status->quiz_cleared ? 'completed' : '' }}">
                                        @if($status->quiz_cleared)
                                        ✅ クリア済み
                                        @if($status->quiz_clear_date)
                                        ({{ \Carbon\Carbon::parse($status->quiz_clear_date)->format('n月j日') }})
                                        @endif
                                        @else
                                        📝 未挑戦
                                        @endif
                                    </div>
                                    <a href="{{ route('points.show', $status->point) }}"
                                        class="btn-mission {{ $status->quiz_cleared ? 'completed' : '' }}">
                                        @if($status->quiz_cleared)
                                        🏆 クリア済み
                                        @else
                                        🚀 チャレンジする
                                        @endif
                                    </a>
                                </div>

                                {{-- 写真投稿ミッション --}}
                                <div class="mission-card">
                                    <div class="mission-icon">📸</div>
                                    <div class="mission-name">写真投稿ミッション</div>
                                    <div class="mission-status {{ $status->photo_cleared ? 'completed' : '' }}">
                                        @if($status->photo_cleared)
                                        ✅ クリア済み
                                        @if($status->photo_clear_date)
                                        ({{ \Carbon\Carbon::parse($status->photo_clear_date)->format('n月j日') }})
                                        @endif
                                        @else
                                        📝 未挑戦
                                        @endif
                                    </div>
                                    @if($status->photo_cleared)
                                    <div class="btn-mission completed">
                                        🏆 クリア済み
                                    </div>
                                    @else
                                    <a href="{{ route('posts.create', ['point_id' => $status->point->id]) }}"
                                        class="btn-mission">
                                        🚀 チャレンジする
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons" style="margin-top: 20px;">
                            <a href="{{ route('points.show', $status->point) }}" class="btn btn-secondary">
                                📖 詳細を見る
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                {{-- 自分の投稿一覧セクション --}}
                <div class="records-card" style="margin-top: 30px;">
                    <h2 class="records-title">自分の投稿一覧</h2>

                    @if($userPosts->count() > 0)
                    <div style="display: grid; gap: 20px;">
                        @foreach($userPosts as $post)
                        <div class="record-card">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                                <div style="flex: 1; min-width: 200px;">
                                    <h3 style="margin: 0 0 10px 0; font-size: 20px; color: #1f2937; font-weight: 600;">
                                        {{ $post->title }}
                                    </h3>
                                    <div class="record-meta">
                                        <span class="record-date">{{ $post->created_at->format('Y年m月d日') }}</span>
                                        @if($post->point)
                                        <span class="record-point">{{ $post->point->name }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn-edit">
                                        ✏️ 編集
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('本当にこの投稿を削除しますか？');"
                                        style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            🗑️ 削除
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="record-body">
                                {{ Str::limit($post->body, 150) }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <p style="font-size: 18px; margin: 0; font-weight: 600;">まだ投稿がありません</p>
                        <p style="margin: 10px 0 0 0;">探索した場所から投稿を作成してみましょう！</p>
                    </div>
                    @endif
                </div>

                <div style="text-align: center; margin-top: 40px;">
                    <a href="{{ route('points.index') }}" class="btn btn-primary">
                        📍 探索ポイント一覧に戻る
                    </a>
                </div>
            </div>
        </div>
</body>

</html>