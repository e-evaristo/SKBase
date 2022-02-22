<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    const PENDING = 1;
    const IN_REVIEW = 2;
    const APPROVED = 3;

    protected $fillable = ['title','slug','category_id','department_id','body','status', 'user_id', 'featured_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function resources()
    {
        return $this->hasMany(ArticleResource::class);
    }
}
