<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>探検記録を書く - 和白探検隊</title>
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
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.3);
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
            background: rgba(16, 185, 129, 0.4);
            border-color: #10b981;
        }

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

        .main-container {
            padding: 100px 20px 40px;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 900px;
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

        .form-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.5);
            position: relative;
        }

        .form-card {
            background: rgba(16, 185, 129, 0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(134, 239, 172, 0.5);
            position: relative;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-label {
            display: block;
            font-size: 18px;
            font-weight: 700;
            color: #a7f3d0;
            margin-bottom: 10px;
            letter-spacing: 0.05em;
        }

        .form-label .required {
            color: #fbbf24;
            font-size: 14px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(134, 239, 172, 0.3);
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: rgba(167, 243, 208, 0.5);
        }

        .form-select option {
            background: #1e293b;
            color: #ffffff;
        }

        .form-textarea {
            resize: vertical;
            min-height: 150px;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .point-display {
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border: 2px solid rgba(134, 239, 172, 0.5);
            color: #86efac;
            font-size: 18px;
            font-weight: 700;
        }

        .error-message {
            color: #fbbf24;
            font-size: 14px;
            margin-top: 8px;
            font-weight: 500;
        }

        .form-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 40px;
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
            border: 2px solid;
            transition: all 0.3s ease;
            letter-spacing: 0.05em;
            cursor: pointer;
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

            .form-card {
                padding: 25px;
            }

            .form-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    @for ($i = 0; $i < 20; $i++)
        <div class="firefly" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 8) }}s;">
        </div>
        @endfor

        <!-- 戻るボタン -->
        <a href="javascript:history.back();" class="back-button">
            ← 戻る
        </a>

        <!-- タグ形式のナビゲーション -->
        <nav class="tag-navigation">
            <a href="{{ route('posts.index') }}" class="nav-tag">📝 投稿一覧</a>
            <a href="{{ route('user-point-status.index') }}" class="nav-tag">⚙️ ステータス</a>
            <a href="{{ route('points.index') }}" class="nav-tag">📍 探索ポイント</a>
        </nav>

        <div class="main-container">
            <div class="content-wrapper">
                <h1 class="page-title">📝 探検記録を書こう 📝</h1>
                <p class="page-subtitle">君の探検の発見や体験をみんなに共有しよう！</p>

                <div class="form-card">
                    {{-- 全体のエラーメッセージ --}}
                    @if(session('error'))
                    <div style="background: rgba(239, 68, 68, 0.2); border: 2px solid #ef4444; padding: 20px; margin-bottom: 20px; color: #fbbf24; font-weight: 700;">
                        ⚠️ {{ session('error') }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div style="background: rgba(16, 185, 129, 0.2); border: 2px solid #10b981; padding: 20px; margin-bottom: 20px; color: #86efac; font-weight: 700;">
                        ✅ {{ session('success') }}
                    </div>
                    @endif

                    <div class="form-card">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            {{-- 場所の選択 --}}
                            <div class="form-section">
                                <label for="point_id" class="form-label">
                                    📍 探索ポイント <span class="required">※必須</span>
                                </label>
                                <select id="point_id" name="point_id" class="form-select" required>
                                    <option value="" disabled {{ !$point && !old('point_id') ? 'selected' : '' }} hidden>探索ポイントを選んでね</option>
                                    @foreach($points as $pointOption)
                                    <option value="{{ $pointOption->id }}"
                                        {{ (old('point_id') == $pointOption->id || ($point && $point->id == $pointOption->id)) ? 'selected' : '' }}>
                                        {{ $pointOption->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('point_id')
                                <p class="error-message">❌ {{ $message }}</p>
                                @enderror
                            </div>

                            {{-- タイトル --}}
                            <div class="form-section">
                                <label for="title" class="form-label">
                                    📝 探検記録のタイトル <span class="required">※必須</span>
                                </label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="form-input"
                                    placeholder="例：きれいな景色を発見！"
                                    required>
                                @error('title')
                                <p class="error-message">❌ {{ $message }}</p>
                                @enderror
                            </div>

                            {{-- 本文 --}}
                            <div class="form-section">
                                <label for="body" class="form-label">
                                    📖 探検記録の内容 <span class="required">※必須</span>
                                </label>
                                <textarea
                                    id="body"
                                    name="body"
                                    class="form-textarea"
                                    placeholder="どんな探検をしたか、見つけたものや感じたことを詳しく教えてね！&#10;例：今日は和白干潟で探検をしました。たくさんのカニを見つけて、潮の満ち引きについて学びました。自然の不思議さに感動しました！"
                                    required>{{ old('body') }}</textarea>
                                @error('body')
                                <p class="error-message">❌ {{ $message }}</p>
                                @enderror
                            </div>

                            {{-- ボタン --}}
                            <div class="form-buttons">
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                                    🔙 やめる
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    📝 探検記録を保存する
                                </button>
                            </div>
                        </form>
                        
                        <script>
                            // フォーム送信時にボタンを無効化して二重送信を防ぐ
                            document.querySelector('form').addEventListener('submit', function(e) {
                                const submitBtn = document.getElementById('submitBtn');
                                submitBtn.disabled = true;
                                submitBtn.textContent = '📝 保存中...';
                                submitBtn.style.opacity = '0.6';
                                submitBtn.style.cursor = 'not-allowed';
                            });
                        </script>
                    </div>
                </div>
            </div>
</body>

</html>