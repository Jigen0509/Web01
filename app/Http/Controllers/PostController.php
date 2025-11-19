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

            return redirect()->route('posts.index')->with('success', '投稿を作成しました');
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
    public function edit(Post $post)
    {
        // 投稿の所有者確認
        if ($post->user_id !== auth()->id()) {
            abort(403, 'この投稿を編集する権限がありません');
        }

        // 探索ポイント一覧を取得
        $points = Point::orderBy('name')->get();

        return view('posts.edit', compact('post', 'points'));
    }

    // 投稿更新 (特定の投稿の更新)
    public function update(Request $request, Post $post)
    {
        // 投稿の所有者確認
        if ($post->user_id !== auth()->id()) {
            abort(403, 'この投稿を更新する権限がありません');
        }

        try {
            // バリデーション
            $validated = $request->validate([
                'title' => 'required|max:255',
                'body' => 'required|max:255',
                'point_id' => 'required|exists:points,id',
            ]);

            // 投稿の更新
            $post->title = $validated['title'];
            $post->body = $validated['body'];
            $post->point_id = $validated['point_id'];
            $post->save();

            \Log::info('Post updated successfully', ['post_id' => $post->id]);

            return redirect()->route('user-point-status.index')->with('success', '投稿を更新しました');
        } catch (\Exception $e) {
            \Log::error('Post update failed', ['message' => $e->getMessage()]);
            return back()->with('error', '投稿の更新に失敗しました')->withInput();
        }
    }

    // 投稿削除 (特定の投稿の削除)
    public function destroy(Post $post)
    {
        // 投稿の所有者確認
        if ($post->user_id !== auth()->id()) {
            abort(403, 'この投稿を削除する権限がありません');
        }

        try {
            $post->delete();
            \Log::info('Post deleted successfully', ['post_id' => $post->id]);

            return redirect()->route('user-point-status.index')->with('success', '投稿を削除しました');
        } catch (\Exception $e) {
            \Log::error('Post deletion failed', ['message' => $e->getMessage()]);
            return back()->with('error', '投稿の削除に失敗しました');
        }
    }
}
