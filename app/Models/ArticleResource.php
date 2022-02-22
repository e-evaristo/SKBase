<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleResource extends Model
{
    use HasFactory;

    protected $fillable = ['description','file'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function add_article_reource($article_id, $url)
    {
        ArticleResource::create([
            'article_id' => $article_id,
            'file' => $url,
            'description' => 'ARTICLE RESOURCE IN BODY',
            'article_content_resource' => true
        ]);
    }
}
