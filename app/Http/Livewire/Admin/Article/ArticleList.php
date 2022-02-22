<?php

namespace App\Http\Livewire\Admin\Article;

use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use App\Models\Department;
use Livewire\WithPagination;
use App\Services\ArticleService;

class ArticleList extends Component
{
    use WithPagination;
    use \WireUi\Traits\Actions;

    public $search, $department_id, $category_id;

    public function getArticlesProperty(ArticleService $service)
    {        
        return $service->list($this->search, $this->department_id, $this->category_id);
    }

    public function getDepartmentsProperty()
    {
        return Department::orderBy('name')->get();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDepartmentId()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function delete(Article $article)
    {
        $article->delete();
        $this->notification()->notify([
            'title'   => 'Article Deleted Successfully.',
            'icon'    => 'info',
            'timeout' => 1000
        ]);
    }
    
    public function render()
    {
        return view('livewire.admin.article.article-list');
    }
}
