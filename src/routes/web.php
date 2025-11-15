<?php

use App\Http\Controllers\PointController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPointStatusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect('/points');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// --- 探索ポイント(point)関連ルート --- 
// ポイント一覧 (場所一覧の表示)
Route::get('/points', [PointController::class, 'index'])->name('points.index');

// ポイント作成 (場所の新規作成)
Route::get('/points/create', [PointController::class, 'create'])->name('points.create')->middleware('auth');

// ポイント詳細 (場所の詳細表示)
Route::get('/points/{point}', [PointController::class, 'show'])->name('points.show');


// --- ユーザー投稿(post)関連ルート ---

// 投稿一覧 (ユーザーの投稿一覧表示)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 投稿作成 (新規投稿フォームの表示)
Route::get('/posts/create/{points?}', action: [PostController::class, 'create'])->name('posts.create')->middleware('auth');

// 投稿保存 (新規投稿の保存)c
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');

// 投稿詳細 (特定の投稿の詳細表示)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 投稿編集 (特定の投稿の編集フォーム表示)
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');

// 投稿更新 (特定の投稿の更新)
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');

// 投稿削除 (特定の投稿の削除)
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');

// --- クイズ(quiz)関連ルート ---

// クイズ一覧 (クイズの一覧表示)
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

// クイズ詳細 (特定のクイズの詳細表示)
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');

// クイズ選択 (クイズの選択画面表示)
Route::get('/quizzes/select', [QuizController::class, 'select'])->name('quizzes.select');

// クイズ開始 (クイズの開始処理)
Route::post('/quizzes/start', [QuizController::class, 'start'])->name('quizzes.start');

// クイズ回答送信 (クイズの回答を送信)
Route::post('/quizzes/submit/{point}', [QuizController::class, 'submit'])->name('quizzes.submit')->middleware('auth');

// --- ユーザーのポイントステータス関連ルート ---

// ユーザーのポイントステータス一覧
Route::get('/user-point-status', [UserPointStatusController::class, 'index'])->name('user-point-status.index');

// ユーザーのポイントステータス詳細(rankカラムの事)
Route::get('/user-point-status/{status}', [UserPointStatusController::class, 'show'])->name('user-point-status.show');

// ユーザーのクイズクリアデータ一覧
Route::get('/user-quiz-clear-data', [UserPointStatusController::class, 'quizClearDataIndex'])->name('user-quiz-clear-data.index');

// ユーザーのクイズクリアデータ詳細
Route::get('/user-quiz-clear-data/{quiz}', [UserPointStatusController::class, 'quizClearDataShow'])->name('user-quiz-clear-data.show');

// ユーザーのphotoクリアデータ一覧
Route::get('/user-photo-clear-data', [UserPointStatusController::class, 'photoClearDataIndex'])->name('user-photo-clear-data.index');

// ユーザーのphotoクリアデータ詳細
Route::get('/user-photo-clear-data/{photo}', [UserPointStatusController::class, 'photoClearDataShow'])->name('user-photo-clear-data.show');
