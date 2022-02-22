<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleService {

    public function list($search = '', $department_id, $category_id)
    {
        return Article::with(['category','department','user'])
            ->when($search, function ($query) use ($search) {
                return $query->where('title','LIKE', '%'.$search.'%');
            })
            ->when($department_id, function ($query) use ($department_id) {
                return $query->where('department_id','=', $department_id);
            })
            ->when($category_id, function ($query) use ($category_id) {
                return $query->where('category_id','=', $category_id);
            })
            ->latest()->paginate(10);
    }
    
    public function save($data)
    {
        return Article::updateOrCreate(
            [
                'id' => $data['article']['id']
            ],
            [
                'title' => $data['article']['title'],
                'slug' => $data['article']['slug'],
                'category_id' => $data['article']['category_id'],
                'department_id' => $data['article']['department_id'],
                'body' => $data['article']['body'],
                'user_id' => $data['article']['user_id'],
                'featured_image' => $data['article']['featured_image'],
            ],
        ); 
    }

    public function deleteFeaturedImage(Article $article)
    {
        if (Storage::exists($article->featured_image)) {
            Storage::delete($article->featured_image);
        }
        $article->featured_image = null;
        $article->save();
    }

}