<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 既存のクイズデータを削除（重複を防ぐため）
        DB::table('quizzes')->truncate();

        $quizzes = [
            // 和白干潟 (point_id: 1)
            ['point_id' => 1, 'question_text' => '和白干潟は、昔、塩を作るための「塩田」だった。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 1, 'question_text' => '和白干潟では、冬になると「ミヤコドリ」という珍しい鳥を見ることができる。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 1, 'question_text' => '和白干潟は、渡り鳥がほとんど飛来しないため、バードウォッチングには向いていない。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // 立花山 (point_id: 2)
            ['point_id' => 2, 'question_text' => '立花山は、戦国時代に「立花道雪」が城主を務めた城があった山である。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 2, 'question_text' => '立花山の名前は、最澄が立てた杖から花が咲いたという伝説に由来する。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 2, 'question_text' => '立花山は標高が3000mを超えるため、本格的な登山装備が必要である。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // 筥崎宮 (point_id: 3)
            ['point_id' => 3, 'question_text' => '筥崎宮の本殿は、「筥崎」と呼ばれる日本で最古の国宝建造物である。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 3, 'question_text' => '筥崎宮には、「亀山」と300歳まで生きたという伝説の「不老水」がある。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 3, 'question_text' => '筥崎宮は、明治時代に建てられた比較的新しい神社である。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // 志賀島 (point_id: 4)
            ['point_id' => 4, 'question_text' => '志賀島で発見された金印には、「漢委奴国王」と刻まれている。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 4, 'question_text' => '志賀島は、昔から陸地と道路に繋がっており、橋でしか行けない。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 4, 'question_text' => '志賀島の「潮見台定期観光バス」からは、福岡市街や志賀海を一望できる。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],

            // 海の中道海浜公園 (point_id: 5)
            ['point_id' => 5, 'question_text' => '海の中道海浜公園の場所は、戦後、米軍の基地として使われていた。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 5, 'question_text' => 'この公園は、「奈多海水浴場と西戸崎」という2つの海に挟まれた砂州にある。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 5, 'question_text' => '海の中道海浜公園には花畑があるが、動物とふれあえるエリアはない。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // 筑前国分寺 (point_id: 6)
            ['point_id' => 6, 'question_text' => '筑前国分寺は、「奈良時代(聖武天皇来朝)」の時に、「国分寺建立」を発願したことで有名である。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 6, 'question_text' => '筑前国分寺の名前は、「忍夜天皇・難波天皇(えんな)を「筑前(ちくぜん)」に入れて祀めたという伝説に由来する。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 6, 'question_text' => '筑前国分寺は、日本三大公寺の一つには数えられていない。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // アイランドシティ (point_id: 7)
            ['point_id' => 7, 'question_text' => 'アイランドシティは、もともとあった香椎の島を埋め立てして作られた。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 7, 'question_text' => '公園の遊具「ぐりんぐりん」は、「緑(グリーン)」がたくさんある意味から名付けられた。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 7, 'question_text' => '「ぐりんぐりん」は、独創的なデザインが特徴の環境省庁舎建築家伊東豊雄が設計した。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],

            // 名島城 (point_id: 8)
            ['point_id' => 8, 'question_text' => '名島城は、豊臣秀吉の命で小早川隆景が築いた城である。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 8, 'question_text' => '黒田長政は、福岡城を築く前、この名島城を居城としていた。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 8, 'question_text' => '名島城は、現在も立派な天守閣がそのままの姿で残っている。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],

            // 三日月山 (point_id: 9)
            ['point_id' => 9, 'question_text' => '三日月山は、山の形が「満月」のように見えることから名付けられた。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 9, 'question_text' => '三日月山には、「立花山城の支城(見張り台)」が置かれていたとされている。', 'correct_answer' => '〇', 'option1' => null, 'option2' => null, 'option3' => null],
            ['point_id' => 9, 'question_text' => '三日月山の山頂は樹木に覆われており、展望はあまり見えない。', 'correct_answer' => '×', 'option1' => null, 'option2' => null, 'option3' => null],
        ];

        foreach ($quizzes as $quiz) {
            DB::table('quizzes')->insert([
                'point_id' => $quiz['point_id'],
                'question_text' => $quiz['question_text'],
                'correct_answer' => $quiz['correct_answer'],
                'option1' => $quiz['option1'],
                'option2' => $quiz['option2'],
                'option3' => $quiz['option3'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
