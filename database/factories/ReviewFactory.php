<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
     public function definition(): array
     {
         
        $positiveComments = json_decode(file_get_contents(storage_path('app/json/positive_reviews.json')), true);
        $negativeComments = json_decode(file_get_contents(storage_path('app/json/negative_reviews.json')), true);

        // ポジ・ネガどちらかランダム（60%でポジ）
        $sentiment = $this->faker->boolean(60) ? 'positive' : 'negative';

        // 文字数カテゴリの決定
        $lengthCategory = collect([
            'short' => [10, 40],
            'medium' => [41, 100],
            'long' => [101, 300],
        ])->keys()->random();

        // 該当カテゴリからランダムに選択
        $commentList = collect(
            $sentiment === 'positive' ? $positiveComments[$lengthCategory] : $negativeComments[$lengthCategory]
        );
        $baseComment = $commentList->random();

        // 口コミの評価とレートの内容を設定
        $rating = $sentiment === 'positive' ?$this->faker->numberBetween(3,5) : $this->faker->numberBetween(1,2);


        return [
            'hospital_id' => rand(1, 50), // 病院ID（50個作ってるならOK）
            'comment' => $baseComment,
            'rating' => $rating,
        ];
        
        
     }
        
}
