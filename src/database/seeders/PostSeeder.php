<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Point;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::query()->delete(); // 既存のデータをクリア

        // ユーザーとポイントが存在することを確認
        $users = User::all();
        $points = Point::all();

        if ($users->isEmpty() || $points->isEmpty()) {
            $this->command->info('ユーザーまたはポイントのデータがないため、投稿シーダーをスキップします。');
            $this->command->info('UserSeederとPointSeederを先に実行してください。');
            return;
        }

        // ポイントを名前で検索するためのヘルパー関数
        $getPointByName = function ($name) use ($points) {
            return $points->firstWhere('name', $name);
        };

        // 和白周辺の投稿データを追加
        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('和白干潟')?->id ?? $points->random()->id,
            'title' => '和白干潟で野鳥観察！',
            'body' => '和白干潟でたくさんの渡り鳥を見ることができました！双眼鏡を持っていくのがおすすめです。',
            'image_path' => null,
            'category' => '自然',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('立花山')?->id ?? $points->random()->id,
            'title' => '立花山ハイキング',
            'body' => '立花山の頂上からの眺めは最高でした！博多湾が一望できて感動しました。',
            'image_path' => null,
            'category' => '体験',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('香椎宮')?->id ?? $points->random()->id,
            'title' => '香椎宮の歴史を感じて',
            'body' => '香椎宮の荘厳な雰囲気に圧倒されました。勅使道を歩くと歴史を感じます。',
            'image_path' => null,
            'category' => '神社仏閣',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('志賀島')?->id ?? $points->random()->id,
            'title' => '志賀島サイクリング',
            'body' => '志賀島を自転車で一周してきました！海岸線の景色が素晴らしかったです。',
            'image_path' => null,
            'category' => '体験',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('海の中道海浜公園')?->id ?? $points->random()->id,
            'title' => '海の中道でピクニック',
            'body' => '家族で海の中道海浜公園に行きました！広い芝生でピクニックを楽しみました。',
            'image_path' => null,
            'category' => '風景',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('筥崎宮')?->id ?? $points->random()->id,
            'title' => '筥崎宮で必勝祈願',
            'body' => '筥崎宮で試験の合格祈願をしてきました。「敵国降伏」の扁額が印象的でした。',
            'image_path' => null,
            'category' => '神社仏閣',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('アイランドシティ中央公園（ぐりんぐりん）')?->id ?? $points->random()->id,
            'title' => 'ぐりんぐりんの不思議な建築',
            'body' => 'ぐりんぐりんの独特な建築デザインに驚きました！屋上庭園も素敵でした。',
            'image_path' => null,
            'category' => '風景',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('名島城跡')?->id ?? $points->random()->id,
            'title' => '名島城跡を探索',
            'body' => '名島城跡の石垣を見学しました。小早川隆景が築いた歴史を感じることができました。',
            'image_path' => null,
            'category' => '歴史',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('三日月山')?->id ?? $points->random()->id,
            'title' => '三日月山から和白を一望',
            'body' => '三日月山の頂上から和白干潟と博多湾が見渡せました！絶景スポットです。',
            'image_path' => null,
            'category' => '自然',
        ]);

        Post::create([
            'user_id' => $users->random()->id,
            'point_id' => $getPointByName('奈多・三苫海岸')?->id ?? $points->random()->id,
            'title' => '奈多海岸で夕日鑑賞',
            'body' => '奈多海岸から見る夕日が本当に美しかったです。海水浴シーズンにまた来たいです！',
            'image_path' => null,
            'category' => '風景',
        ]);
    }
}
