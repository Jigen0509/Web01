<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Point;
use App\Models\UserPointStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // クイズ一覧 (クイズの一覧表示)
    public function index()
    {
        // ここにクイズ一覧を取得するロジックを実装
        return view('quizzes.index'); // ビューを返す
    }

    // クイズ詳細 (特定のクイズの詳細表示)  
    public function show($quiz)
    {
        // 指定されたクイズを取得（変数名を明確に）
        $currentQuiz = Quiz::findOrFail($quiz); // $quiz(ID) から Quizオブジェクトを取得

        // そのクイズが属するポイントの全ての問題を取得
        $questions = Quiz::where('point_id', $currentQuiz->point_id)
            ->orderBy('id') // IDの昇順で並び替え
            ->get();

        // ポイント情報も取得（タイトル表示用）
        $point = $currentQuiz->point;

        return view('quizzes.show', compact('questions', 'point'));
    }

    // クイズ選択 (クイズの選択画面表示)
    public function select()
    {
        // ここにクイズ選択画面を表示するロジックを実装
        return view('quizzes.select'); // ビューを返すs
    }

    // クイズ開始 (クイズの開始処理)
    public function start(Request $request)
    {
        // バリデーション
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id' // questionsテーブルのidに存在するか確認
        ]);
        // ここにクイズ開始処理を実装
        return redirect()->route('quizzes.show', ['quiz' => $request->input('quiz_id')]); // クイズ詳細へリダイレクト
    }

    // クイズ回答送信処理
    public function submit(Request $request, $pointId)
    {
        $user = Auth::user();
        $point = Point::findOrFail($pointId);

        // そのポイントのすべてのクイズを取得
        $questions = Quiz::where('point_id', $pointId)->get();

        // 全問正解かチェック
        $allCorrect = true;
        $correctCount = 0;

        foreach ($questions as $question) {
            $userAnswer = $request->input('answer_' . $question->id);

            if ($userAnswer === $question->correct_answer) {
                $correctCount++;
            } else {
                $allCorrect = false;
            }
        }

        $earnedPoints = 0;

        // 結果に応じて処理
        if ($allCorrect) {
            // 全問正解: ポイント付与
            $pointsToEarn = 10; // 1ポイントあたり10ポイント

            // UserPointStatusを更新または作成
            $userPointStatus = UserPointStatus::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'point_id' => $pointId
                ],
                [
                    'point_earned' => 0,
                    'visit_date' => now()
                ]
            );

            // まだクリアしていない場合のみポイント付与
            if (!$userPointStatus->is_cleared) {
                $userPointStatus->point_earned = $pointsToEarn;
                $userPointStatus->is_cleared = true;
                $userPointStatus->clear_date = now();
                $userPointStatus->save();

                // ユーザーの総ポイントを更新
                $user->total_point += $pointsToEarn;

                // ランク更新
                $totalPoints = Point::count();
                $clearedPoints = UserPointStatus::where('user_id', $user->id)
                    ->where('is_cleared', true)
                    ->count();
                $clearRate = $totalPoints > 0 ? ($clearedPoints / $totalPoints) : 0;

                if ($clearRate >= 0.8) {
                    $user->rank = 'ゴールド';
                } elseif ($clearRate >= 0.5) {
                    $user->rank = 'シルバー';
                } else {
                    $user->rank = 'ブロンズ';
                }

                $user->save();

                $earnedPoints = $pointsToEarn;
            }
        }

        // 結果ページへリダイレクト
        return view('quizzes.result', [
            'allCorrect' => $allCorrect,
            'correctCount' => $correctCount,
            'totalQuestions' => $questions->count(),
            'pointsEarned' => $earnedPoints,
            'pointId' => $pointId,
            'firstQuizId' => $questions->first()->id,
        ]);
    }
}
