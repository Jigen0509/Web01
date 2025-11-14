<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserPointStatus; // UserPointStatusモデルをuseする
use App\Models\User; // Userモデルをuseする
use App\Models\Point; // Pointモデルをuseする

class UserPointStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UserPointStatus::truncate(); // 既存のデータをクリア

        $users = User::all();
        $points = Point::all();

        if ($users->isEmpty() || $points->isEmpty()) {
            $this->command->info('ユーザーまたはポイントのデータがないため、UserPointStatusシーダーをスキップします。');
            $this->command->info('UserSeederとPointSeederを先に実行してください。');
            return;
        }

        // 各ユーザーがいくつかのポイントをクリアした状況をシミュレート
        foreach ($users as $user) {
            // 各ユーザーがランダムに2〜3個のポイントをクリアしたと仮定
            $clearedPoints = $points->random(rand(2, min(3, $points->count())));

            foreach ($clearedPoints as $point) {
                UserPointStatus::create([
                    'user_id' => $user->id,
                    'point_id' => $point->id,
                    'quiz_cleared' => rand(0, 1) == 1, // 50%の確率でクイズクリア
                    'quiz_clear_date' => (rand(0, 1) == 1) ? now()->subDays(rand(1, 30)) : null, // クリアしていれば日付も
                    'photo_cleared' => rand(0, 1) == 1, // 50%の確率で写真アップロード
                    'photo_clear_date' => (rand(0, 1) == 1) ? now()->subDays(rand(1, 30)) : null,
                ]);
            }
        }
    }
}
