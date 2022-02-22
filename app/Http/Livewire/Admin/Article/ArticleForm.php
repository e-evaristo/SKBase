<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\User;
use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use App\Models\Department;
use App\Services\ArticleService;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ArticleForm extends Component
{
    use \WireUi\Traits\Actions;
    use WithFileUploads;
    public Article $article;
    public $featured_image;

    public function rules() 
    {
        return [
            'article.title' => 'required|string|max:100',
            'article.slug' => 'required|unique:articles,slug,' . $this->article->id,
            'article.category_id' => 'required',
            'article.department_id' => 'required',
            'article.body' => 'required',
            'article.user_id' => 'required',
            'featured_image' => 'nullable|image|max:4096'
        ];
    }

    public function mount(Article $article)
    {
        if (empty($article)) {
            $this->article = new Article();
        } else {
            $this->article = $article;
        }
    }

    public function getDepartmentsProperty()
    {
        return Department::orderBy('name')->get();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    public function getUsersProperty()
    {
        return User::orderBy('name')->get();
    }

    public function updatedArticleTitle($value)
    {
        $this->article->slug = Str::slug($value);
    }

    public function returnToList()
    {
        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        return redirect()->route('admin.articles.form', $article);
    }
    
    public function save(ArticleService $service)
    {
        $validated = $this->validate();
        $validated['article']['id'] = $this->article->id;
        
        isset($this->featured_image) ? 
            $validated['article']['featured_image'] = $this->featured_image->store('public/articles') : 
            $validated['article']['featured_image'] = $this->article->featured_image;
        
        $this->article = $service->save($validated);

        $this->notification()->notify([
            'title'   => (empty($this->article->id) ? 'Article Created Successfully.' : 'Article Updated Successfully.') ,
            'icon'    => 'success',
            'timeout' => 1000,
            'onClose' => [
                'method' => 'edit',
                'params' => $this->article->id,
            ],
        ]);
    }

    public function deleteFeaturedImage(ArticleService $service)
    {
        $service->deleteFeaturedImage($this->article);
        $this->featured_image = null;
        $this->article->featured_image = null;
    }
    
    public function render()
    {
        return view('livewire.admin.article.article-form');
    }
}
