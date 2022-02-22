<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory(15)->create()->each(function(Article $article) {
            /*ArticleResource::factory(1)->create([
                'article_id' => $article->id
            ]);*/
        });
    }
}
