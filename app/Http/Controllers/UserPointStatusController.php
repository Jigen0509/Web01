<?php

namespace App\Http\Controllers;

use App\Models\UserPointStatus;
use App\Models\Post;
use Illuminate\Http\Request;

class UserPointStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ユーザーのポイントステータス一覧
    public function index()
    {
        // 必要なデータを取得
        $user = auth()->user();
        // クイズまたは写真のいずれかがクリアされている場合のみ取得
        $userStatuses = UserPointStatus::with('point')
            ->where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('quiz_cleared', true)
                    ->orWhere('photo_cleared', true);
            })
            ->get();

        $totalVisited = $userStatuses->count();
        $totalQuizCleared = $userStatuses->where('quiz_cleared', true)->count();
        $totalPhotoCleared = $userStatuses->where('photo_cleared', true)->count();

        // 実際の投稿数を取得
        $totalPosts = Post::where('user_id', $user->id)->count();

        // ユーザーの投稿一覧を取得（最新順、ポイント情報も含める）
        $userPosts = Post::where('user_id', $user->id)
            ->with('point')
            ->latest()
            ->get();

        // ランクとポイントの計算
        $this->updateUserRankAndPoints($user, $totalVisited, $totalQuizCleared, $totalPhotoCleared);

        // ランク画像の取得
        $rankImage = $this->getRankImage($user->rank);

        return view('user_point_status.index', compact(
            'user',
            'userStatuses',
            'totalVisited',
            'totalQuizCleared',
            'totalPhotoCleared',
            'totalPosts',
            'userPosts',
            'rankImage'
        ));
    }

    /**
     * ユーザーのランクとポイントを更新
     */
    private function updateUserRankAndPoints($user, $totalVisited, $totalQuizCleared, $totalPhotoCleared)
    {
        // 全ポイント数（訪問した場所 × 2ミッション）
        $totalMissions = $totalVisited * 2;

        // クリアしたミッション数
        $clearedMissions = $totalQuizCleared + $totalPhotoCleared;

        // ポイントの計算（クリアしたミッション数 × 10ポイント）
        $totalPoints = $clearedMissions * 10;

        // ランクの判定（ポイント制）
        if ($totalPoints < 50) {
            $newRank = 'フィールド調査員';
        } elseif ($totalPoints < 100) {
            $newRank = 'エキスパート';
        } elseif ($totalPoints < 150) {
            $newRank = 'マスター';
        } else {
            $newRank = 'レジェンド';
        }

        // ランクとポイントが変更された場合のみ更新
        if ($user->rank !== $newRank || $user->total_point !== $totalPoints) {
            $user->rank = $newRank;
            $user->total_point = $totalPoints;
            $user->save();
        }
    }

    /**
     * ランクに対応する画像パスを取得
     */
    private function getRankImage($rank)
    {
        $imageMap = [
            'フィールド調査員' => asset('image/フィールド調査委員.png'),
            'エキスパート' => asset('image/エキスパート.png'),
            'マスター' => asset('image/マスター.png'),
            'レジェンド' => asset('image/レジェンド.png'),
        ];

        return $imageMap[$rank] ?? asset('image/フィールド調査委員.png');
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
