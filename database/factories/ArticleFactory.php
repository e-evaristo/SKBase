<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->text(800),
            'status' => $this->faker->randomElement([Article::PENDING, Article::IN_REVIEW, Article::APPROVED]),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'department_id' => Department::all()->random()->id,
        ];
    }
}
