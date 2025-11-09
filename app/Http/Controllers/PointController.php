<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PointController extends Controller
{
    // ポイント一覧 (場所一覧の表示)
    public function index()
    {
        // ここにポイント一覧を取得するロジックを実装
        return view('points.index'); // ビューを返す
    }

    // ポイント詳細 (場所の詳細表示)
    public function show($point)
    {
        // ここに特定のポイントの詳細を取得するロジックを実装
        return view('points.show', compact('point')); // ビューを返す
    }

    // ポイント作成 (場所の新規作成)
    public function create()
    {
        // ここにポイント作成フォームを表示するロジックを実装
        return view('points.create'); // ビューを返す
    }
}
