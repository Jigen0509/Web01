<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Point;

class QuizSeeder extends Seeder
{
    public function run()
    {
        if (Point::count() === 0) {
            $this->command->info('ポイントのデータがないため、クイズシーダーをスキップします。');
            return;
        }

        Quiz::truncate();

        $points = [
            '和白干潟' => Point::where('name', '和白干潟')->first(),
            '立花山' => Point::where('name', '立花山')->first(),
            '香椎宮' => Point::where('name', '香椎宮')->first(),
            '志賀島' => Point::where('name', '志賀島')->first(),
            '海の中道海浜公園' => Point::where('name', '海の中道海浜公園')->first(),
            '筥崎宮' => Point::where('name', '筥崎宮')->first(),
            'ぐりんぐりん' => Point::where('name', 'アイランドシティ中央公園（ぐりんぐりん）')->first(),
            '名島城跡' => Point::where('name', '名島城跡')->first(),
            '三日月山' => Point::where('name', '三日月山')->first(),
            '奈多三苫海岸' => Point::where('name', '奈多三苫海岸')->first(),
        ];

        $quizData = [
            ['point' => '和白干潟', 'question' => '和白干潟は、昔、塩を作るための「塩田」だった。', 'answer' => '〇'],
            ['point' => '和白干潟', 'question' => '和白干潟では、冬になると「ミヤコドリ」という珍しい鳥を見ることができる。', 'answer' => '〇'],
            ['point' => '和白干潟', 'question' => '和白干潟は、渡り鳥がほとんど飛来しないため、バードウォッチングには向いていない。', 'answer' => '×'],
            ['point' => '立花山', 'question' => '立花山は、戦国時代に「立花道雪」が城主を務めた城があった山である。', 'answer' => '〇'],
            ['point' => '立花山', 'question' => '立花山の名前は、最澄が立てた杖から花が咲いたという伝説に由来する。', 'answer' => '〇'],
            ['point' => '立花山', 'question' => '立花山は標高が3000mを超えるため、本格的な登山装備が必要である。', 'answer' => '×'],
            ['point' => '香椎宮', 'question' => '香椎宮の本殿は、「香椎造」と呼ばれる日本で唯一の建築様式である。', 'answer' => '〇'],
            ['point' => '香椎宮', 'question' => '香椎宮には、飲むと300歳まで生きたという伝説の「不老水」がある。', 'answer' => '〇'],
            ['point' => '香椎宮', 'question' => '香椎宮は、明治時代に建てられた比較的新しい神社である。', 'answer' => '×'],
            ['point' => '志賀島', 'question' => '志賀島で発見された金印には「漢委奴国王」と刻まれている。', 'answer' => '〇'],
            ['point' => '志賀島', 'question' => '志賀島は、昔から陸地と完全に離れており、橋でしか行けない。', 'answer' => '×'],
            ['point' => '志賀島', 'question' => '志賀島の「潮見公園展望台」からは、福岡市街や博多湾を一望できる。', 'answer' => '〇'],
            ['point' => '海の中道海浜公園', 'question' => '海の中道海浜公園の場所は、戦後、米軍の基地として使われていた。', 'answer' => '〇'],
            ['point' => '海の中道海浜公園', 'question' => 'この公園は、博多湾と玄界灘という2つの海に挟まれた砂州にある。', 'answer' => '〇'],
            ['point' => '海の中道海浜公園', 'question' => '海の中道海浜公園には花畑はあるが、動物とふれあえるエリアはない。', 'answer' => '×'],
            ['point' => '筥崎宮', 'question' => '筥崎宮は、元寇（蒙古襲来）の際に「敵国降伏」を祈願したことで有名である。', 'answer' => '〇'],
            ['point' => '筥崎宮', 'question' => '筥崎宮の名前は、応神天皇の胞衣（えな）を「筥（はこ）」に入れて埋めたという伝説に由来する。', 'answer' => '〇'],
            ['point' => '筥崎宮', 'question' => '筥崎宮は、日本三大八幡宮の一つには数えられていない。', 'answer' => '×'],
            ['point' => 'ぐりんぐりん', 'question' => 'アイランドシティは、もともとあった自然の島を整備して作られた。', 'answer' => '×'],
            ['point' => 'ぐりんぐりん', 'question' => '公園の建物「ぐりんぐりん」は、「緑（グリーン）」がたくさんある様子から名付けられた。', 'answer' => '〇'],
            ['point' => 'ぐりんぐりん', 'question' => '「ぐりんぐりん」は、曲線的なデザインが特徴の建築家伊東豊雄氏が設計した。', 'answer' => '〇'],
            ['point' => '名島城跡', 'question' => '名島城は、豊臣秀吉の命で小早川隆景が築いた城である。', 'answer' => '〇'],
            ['point' => '名島城跡', 'question' => '黒田長政は、福岡城を築く前、この名島城を居城としていた。', 'answer' => '〇'],
            ['point' => '名島城跡', 'question' => '名島城は、現在も立派な天守閣がそのままの姿で残っている。', 'answer' => '×'],
            ['point' => '三日月山', 'question' => '三日月山は、山の形が「満月」のように見えることから名付けられた。', 'answer' => '×'],
            ['point' => '三日月山', 'question' => '三日月山には、立花山城の支城（砦）が置かれていたとされている。', 'answer' => '〇'],
            ['point' => '三日月山', 'question' => '三日月山の山頂は樹木に覆われており、景色はあまり見えない。', 'answer' => '×'],
            ['point' => '奈多三苫海岸', 'question' => '奈多三苫海岸は、博多湾に面しており、波はとても穏やかである。', 'answer' => '×'],
            ['point' => '奈多三苫海岸', 'question' => 'この海岸は、古くから「白砂青松（はくしゃせいしょう）」の景勝地として知られている。', 'answer' => '〇'],
            ['point' => '奈多三苫海岸', 'question' => 'この海岸は、玄界灘に沈む夕日の名所としても知られている。', 'answer' => '〇'],
        ];

        foreach ($quizData as $data) {
            $point = $points[$data['point']];
            if ($point) {
                Quiz::create([
                    'point_id' => $point->id,
                    'question_text' => $data['question'],
                    'correct_answer' => $data['answer'],
                    'option1' => '〇',
                    'option2' => '×',
                    'option3' => null,
                ]);
            }
        }
    }
}
