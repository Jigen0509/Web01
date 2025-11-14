<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // DBファサードをuseする
use App\Models\User; // testユーザーを追加した場合に必要

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        echo "DatabaseSeeder: Starting...\n";

        // 外部キー制約を一時的に無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        echo "DatabaseSeeder: Foreign key checks disabled\n";

        // UserSeederはLaravel Breeze/Jetstreamで生成されるauth.phpでUserモデルを
        // 既に作成しているため、ここではUser::factory(10)->create(); はコメントアウトします。
        // もしUserSeederを別途作成した場合は、それもここで呼び出せます。
        // $this->call(UserSeeder::class);

        // テスト用のユーザーを1人作成
        echo "DatabaseSeeder: Creating test user...\n";
        User::firstOrCreate(
            ['email' => 'test@example.com'], // emailが既に存在すれば作成しない
            [
                'name' => 'テストユーザー',
                'password' => 'password', // パスワードは'password' (自動的にハッシュ化される)
                'email_verified_at' => now(), // メール認証済みとしておく
                'total_point' => 0,
                'rank' => '初心者',
            ]
        );
        echo "DatabaseSeeder: Test user created\n";
        echo "DatabaseSeeder: Test user created\n";

        // 自分で作成したシーダーを呼び出します
        // 依存関係のあるテーブル（子テーブル）から先にtruncateされるように、
        // 呼び出し順序を考慮するとより安全です。
        // UserPointStatus -> Posts -> Quizzes -> Points の順でtruncateされるように、
        // 呼び出し順序を逆にします（親テーブルを先に呼び出す）
        echo "DatabaseSeeder: Calling seeders...\n";
        $this->call([
            PointSeeder::class,
            QuizSeeder::class,
            PostSeeder::class,
            UserPointStatusSeeder::class,
            // UserSeederは通常認証で作成されるか、上記でfirstOrCreateを使っているので、
            // ここで呼び出す必要は通常ありません。
        ]);
        echo "DatabaseSeeder: Seeders completed\n";

        // 外部キー制約を再度有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        echo "DatabaseSeeder: Foreign key checks enabled\n";
        echo "DatabaseSeeder: Finished!\n";
    }
}
