<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // ここに特定のクイズの詳細を取得するロジックを実装
        return view('quizzes.show', compact('quiz')); // ビューを返す
    }

    // クイズ選択 (クイズの選択画面表示)
    public function select()
    {
        // ここにクイズ選択画面を表示するロジックを実装
        return view('quizzes.select'); // ビューを返す
    }

    // クイズ開始 (クイズの開始処理)
    public function start(Request $request)
    {
        // ここにクイズ開始処理を実装
        return redirect()->route('quizzes.show', ['quiz' => $request->input('quiz_id')]); // クイズ詳細へリダイレクト
    }
}
