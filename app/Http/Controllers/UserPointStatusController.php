<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPointStatusController extends Controller
{
    // ユーザーのポイントステータス一覧
    public function index()
    {
        // ここにユーザーのポイントステータス一覧を取得するロジックを実装
        return view('user_point_status.index'); // ビューを返す
    }

    // ユーザーのポイントステータス詳細
    public function show($userPointStatus)
    {
        // ここに特定のユーザーのポイントステータス詳細を取得するロジックを実装
        return view('user_point_status.show', compact('userPointStatus')); // ビューを返す
    }

    // ユーザーのクイズクリアデータ一覧
    public function quizClearDataIndex()
    {
        // ここにユーザーのクイズクリアデータ一覧を取得するロジックを実装
        return view('user_point_status.quiz_clear_data_index'); // ビューを返す
    }

    // ユーザーのクイズクリアデータ詳細
    public function quizClearDataShow($quiz)
    {
        // ここに特定のユーザーのクイズクリアデータ詳細を取得するロジックを実装
        return view('user_point_status.quiz_clear_data_show', compact('quiz')); // ビューを返す
    }

    // ユーザーのphotoクリアデータ一覧
    public function photoClearDataIndex()
    {
        // ここにユーザーのphotoクリアデータ一覧を取得するロジックを実装
        return view('user_point_status.photo_clear_data_index'); // ビューを返す
    }

    // ユーザーのphotoクリアデータ詳細
    public function photoClearDataShow($photo)
    {
        // ここに特定のユーザーのphotoクリアデータ詳細を取得するロジックを実装
        return view('user_point_status.photo_clear_data_show', compact('photo')); // ビューを返す
    }
}
