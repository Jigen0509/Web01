<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿一覧 (ユーザーの投稿一覧表示)
    public function index()
    {
        // ここに投稿一覧を取得するロジックを実装
        return view('posts.index'); // ビューを返す
    }

    // 投稿詳細 (特定の投稿の詳細表示)
    public function show($post)
    {
        // ここに特定の投稿の詳細を取得するロジックを実装
        return view('posts.show', compact('post')); // ビューを返す
    }

    // 投稿作成 (新規投稿フォームの表示)
    public function create()
    {
        // ここに投稿作成フォームを表示するロジックを実装
        return view('posts.create'); // ビューを返す
    }

    // 投稿保存 (新規投稿の保存)
    public function store(Request $request)
    {
        // ここに新規投稿を保存するロジックを実装
        // バリデーションや保存処理を行う
        return redirect()->route('posts.index'); // 投稿一覧へリダイレクト
    }

    // 投稿編集 (特定の投稿の編集フォーム表示)
    public function edit($post)
    {
        // ここに特定の投稿の編集フォームを表示するロジックを実装
        return view('posts.edit', compact('post')); // ビューを返す
    }

    // 投稿更新 (特定の投稿の更新)
    public function update(Request $request, $post)
    {
        // ここに特定の投稿を更新するロジックを実装
        // バリデーションや更新処理を行う
        return redirect()->route('posts.show', $post); // 投稿詳細へリダイレクト
    }

    // 投稿削除　(特定の投稿の削除)
    public function destoroy($post)
    {
        // ここに特定の投稿を削除するロジックを実装
        // 削除処理を行う
        return redirect()->route('posts.index'); // 投稿一覧へリダイレクト
    }
}
