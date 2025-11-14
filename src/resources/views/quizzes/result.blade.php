<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ結果 - 和白探索アプリ</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        .result-container {
            max-width: 600px;
            margin: 40px 20px;
            position: relative;
            z-index: 1;
        }

        .result-card {
            background: rgba(16, 185, 129, 0.25);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(16, 185, 129, 0.4);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .result-icon {
            font-size: 6rem;
            margin-bottom: 20px;
            animation: popIn 0.5s ease-out;
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .result-title {
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .result-title.success {
            color: #10b981;
        }

        .result-title.failure {
            color: #f59e0b;
        }

        .result-message {
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 500;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .score-display {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .score-text {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .score-number {
            font-size: 3rem;
            font-weight: 900;
            color: #10b981;
        }

        .points-earned {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .points-text {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .retry-button,
        .point-button {
            padding: 15px 50px;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .retry-button {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
        }

        .retry-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(245, 158, 11, 0.6);
        }

        .point-button {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .point-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.6);
        }

        .back-button {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 12px 40px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .encouragement {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .encouragement-text {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <video class="video-background" autoplay muted loop playsinline>
        <source src="/image/Looping_Video_Day_to_Night.mp4" type="video/mp4">
    </video>

    <div class="result-container">
        <div class="result-card">
            @if($allCorrect)
            <!-- 全問正解の場合 -->
            <div class="result-icon">🎉</div>
            <h1 class="result-title success">クリア！</h1>
            <p class="result-message">おめでとうございます！<br>全問正解です！</p>

            <div class="score-display">
                <div class="score-text">正解数</div>
                <div class="score-number">{{ $correctCount }}/{{ $totalQuestions }}</div>
            </div>

            @if($pointsEarned > 0)
            <div class="points-earned">
                <div class="points-text">🌟 {{ $pointsEarned }}ポイント獲得！🌟</div>
            </div>
            @else
            <div class="encouragement">
                <p class="encouragement-text">このポイントは既にクリア済みです！<br>他のポイントにも挑戦してみましょう！</p>
            </div>
            @endif

            <div class="button-group">
                <a href="{{ route('points.show', $pointId) }}" class="point-button">
                    場所詳細に戻る
                </a>
                <a href="{{ route('points.index') }}" class="back-button">
                    探索ポイント一覧へ
                </a>
            </div>

            @else
            <!-- 不正解があった場合 -->
            <div class="result-icon">💪</div>
            <h1 class="result-title failure">もう少し！</h1>
            <p class="result-message">惜しい！あと少しです！</p>

            <div class="score-display">
                <div class="score-text">正解数</div>
                <div class="score-number">{{ $correctCount }}/{{ $totalQuestions }}</div>
            </div>

            <div class="encouragement">
                <p class="encouragement-text">
                    全問正解まであと{{ $totalQuestions - $correctCount }}問です！<br>
                    もう一度チャレンジしてみましょう！<br>
                    きっとクリアできますよ！✨
                </p>
            </div>

            <div class="button-group">
                <a href="{{ route('quizzes.show', $firstQuizId) }}" class="retry-button">
                    もう一度挑戦する
                </a>
                <a href="{{ route('points.show', $pointId) }}" class="back-button">
                    場所詳細に戻る
                </a>
            </div>
            @endif
        </div>
    </div>
</body>

</html>