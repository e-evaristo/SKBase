<?php

namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function list($search)
    {
        return Category::withCount('articles')
            ->when($search, function ($query) use ($search) {
                return $query->where('name','LIKE', '%'.$search.'%');
            })
            ->orderBy('name')->paginate(10);
    }
    
    public function save($data)
    {
        return Category::updateOrCreate(
            ['id' => $data['id']],
            [
                'name' => $data['name'],
                'slug' => $data['slug']
            ],
        );
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}