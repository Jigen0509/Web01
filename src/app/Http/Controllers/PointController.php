<?php

namespace App\Http\Controllers;

use App\Models\Point; // Assuming you have a Point model
use Illuminate\Http\Request;
use Illuminate\View\View;



class PointController extends Controller
{
    // ポイント一覧 (場所一覧の表示)
    public function index(Request $request): View
    {
        // ここにポイント一覧を取得するロジックを実装
        $points = Point::orderBy('name')->paginate(10); // 例として、名前でソートして10件ずつ取得
        return view('points.index', compact('points')); // ビューを返す
    }

    // ポイント詳細 (場所の詳細表示)
    public function show(Point $point)
    {


        return view('points.show', compact('point')); // ビューを返す
    }

    // ポイント作成 (場所の新規作成)
    public function create()
    {
        // ここにポイント作成フォームを表示するロジックを実装
        return view('points.create'); // ビューを返す
    }
}
