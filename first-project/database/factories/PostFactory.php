<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //bir tane örnek oluşturuyoruz post için
            'user_id'=>1,
            //sentence ile cümle oluşturuyoruz
            'title'=>fake()->sentence(),
            //paragraph ile paragraf oluşturuyoruz
            'body'=>fake()->paragraph(20),

        ];
    }
}
