<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $point->name }}のクイズ - 和白探索アプリ</title>
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

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 900;
            color: #ffffff;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .description-box {
            background: rgba(16, 185, 129, 0.25);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(16, 185, 129, 0.4);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .description-text {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .quiz-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .question-card {
            background: rgba(16, 185, 129, 0.2);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .question-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #10b981;
            margin-bottom: 15px;
        }

        .question-text {
            font-size: 1.2rem;
            color: #ffffff;
            line-height: 1.8;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .options-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .option-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .option-label:hover {
            background: rgba(16, 185, 129, 0.3);
            border-color: rgba(16, 185, 129, 0.6);
            transform: translateX(5px);
        }

        /* ラジオボタンを非表示 */
        .option-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* カスタムチェックボックス */
        .custom-checkbox {
            width: 24px;
            height: 24px;
            border: 2px solid rgba(16, 185, 129, 0.6);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        /* チェックマーク */
        .custom-checkbox::after {
            content: '';
            width: 6px;
            height: 12px;
            border: solid #ffffff;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg) scale(0);
            transition: all 0.3s ease;
        }

        /* 選択時のスタイル */
        .option-radio:checked+.custom-checkbox {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-color: #10b981;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.6);
        }

        .option-radio:checked+.custom-checkbox::after {
            transform: rotate(45deg) scale(1);
        }

        .option-text {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .button-container {
            text-align: center;
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        .submit-button {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 700;
            padding: 18px 60px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.6);
        }

        .back-button {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 12px 40px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.2);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(239, 68, 68, 0.4);
            border-radius: 10px;
            padding: 15px;
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.3);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(16, 185, 129, 0.5);
            border-radius: 10px;
            padding: 15px;
            color: #ffffff;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <video class="video-background" autoplay muted loop playsinline>
        <source src="{{ secure_asset('image/Looping_Video_Day_to_Night.mp4') }}" type="video/mp4">
    </video>

    <div class="container">
        <h1 class="page-title">{{ $point->name }}のクイズ！</h1>

        <div class="description-box">
            <p class="description-text">
                全{{ $questions->count() }}問に回答してください！すべて回答したら、回答ボタンを押してね！
            </p>
        </div>

        @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('quizzes.submit', $point->id) }}" class="quiz-form">
            @csrf

            @foreach($questions as $index => $question)
            <div class="question-card">
                <div class="question-number">問題{{ $index + 1 }}</div>
                <p class="question-text">{{ $question->question_text }}</p>

                <div class="options-container">
                    @if($question->option1)
                    <label class="option-label">
                        <input type="radio"
                            name="answer_{{ $question->id }}"
                            value="{{ $question->option1 }}"
                            class="option-radio"
                            required>
                        <span class="custom-checkbox"></span>
                        <span class="option-text">{{ $question->option1 }}</span>
                    </label>
                    @endif

                    @if($question->option2)
                    <label class="option-label">
                        <input type="radio"
                            name="answer_{{ $question->id }}"
                            value="{{ $question->option2 }}"
                            class="option-radio"
                            required>
                        <span class="custom-checkbox"></span>
                        <span class="option-text">{{ $question->option2 }}</span>
                    </label>
                    @endif

                    @if($question->option3)
                    <label class="option-label">
                        <input type="radio"
                            name="answer_{{ $question->id }}"
                            value="{{ $question->option3 }}"
                            class="option-radio"
                            required>
                        <span class="custom-checkbox"></span>
                        <span class="option-text">{{ $question->option3 }}</span>
                    </label>
                    @endif
                </div>
            </div>
            @endforeach

            <div class="button-container">
                <button type="submit" class="submit-button">
                    回答を送信する
                </button>

                <a href="{{ route('points.show', $point->id) }}" class="back-button">
                    場所詳細に戻る
                </a>
            </div>
        </form>
    </div>
</body>

</html>