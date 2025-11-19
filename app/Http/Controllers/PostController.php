<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Point;


class PostController extends Controller
{
    // 投稿一覧 (ユーザーの投稿一覧表示)
    public function index()
    {
        // ここに投稿一覧を取得するロジックを実装
        $posts = Post::latest()->get(); // 最新の投稿を取得
        return view('posts.index', compact('posts')); // ビューを返す
    }

    // 投稿詳細 (特定の投稿の詳細表示)
    public function show(Post $post)
    {
        // ここに特定の投稿の詳細を取得するロジックを実装
        return view('posts.show', compact('post')); // ビューを返す
    }

    // 投稿作成 (新規投稿フォームの表示)
    public function create()
    {
        // point_idがクエリパラメータで指定されている場合は取得
        $point = null;
        if (request()->has('point_id')) {
            $point = Point::find(request('point_id'));
        }

        // データベースから実際の探索ポイントを取得
        $points = Point::orderBy('name')->get();

        return view('posts.create', compact('point', 'points')); // ビューを返す
    }

    // 投稿保存 (新規投稿の保存)
    public function store(Request $request)
    {
        try {
            // バリデーション
            $validated = $request->validate([
                'title' => 'required|max:255',
                'body' => 'required|max:255',
                'point_id' => 'required|exists:points,id',
                // image_path は後で実装予定
            ]);

            // ユーザー認証確認
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'ログインが必要です');
            }

            // 投稿の作成
            $post = new Post();
            $post->title = $validated['title'];
            $post->body = $validated['body'];
            $post->category = ''; // カテゴリは空文字列を設定
            $post->point_id = $validated['point_id'];
            $post->user_id = auth()->id(); // ログインユーザーのID
            $post->image_path = ''; // 後で画像アップロード機能を実装
            $post->save();
            
            \Log::info('Post created successfully', ['post_id' => $post->id, 'title' => $post->title]);
            
            return redirect()->route('posts.show', $post)->with('success', '投稿を作成しました');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Post creation failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', '投稿の作成に失敗しました: ' . $e->getMessage())->withInput();
        }
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
