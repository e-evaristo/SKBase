<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('public/articles');
        Storage::makeDirectory('public/articles');
        
        $this->call(UserSeeder::class);
        Category::factory(12)->create();
        Department::factory(6)->create();
        $this->call(ArticleSeeder::class);
    }
}
