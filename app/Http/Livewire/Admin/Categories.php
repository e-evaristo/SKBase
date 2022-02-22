<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\CategoryService;

class Categories extends Component
{
    use WithPagination;
    use \WireUi\Traits\Actions;
    
    public $search, $cardModal, $name, $slug, $category_id;

    protected $rules = [
        'name' => 'required|string|max:100',
        'slug' => 'required|unique:categories',
    ];

    protected $validationAttributes  = [
        'name' => 'Name',
        'name' => 'Slug'
    ];

    public function getCategoriesProperty(CategoryService $service)
    {
        return $service->list($this->search);
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->clearValidation();
        $this->reset(['name', 'slug', 'category_id']);
        $this->cardModal = true;
    }

    public function edit(Category $category)
    {
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->cardModal = true;
    }

    public function store(CategoryService $service) 
    {
        $this->validate();
        $service->save([
            'id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug
        ]);
        
        $this->notification()->notify([
            'title'   => 'Category Created Successfully.',
            'icon'    => 'success',
            'timeout' => 2000,
            'dense'   => true
        ]);
        $this->cardModal = false;
    }

    public function update(CategoryService $service) 
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|unique:categories,slug,' . $this->category_id,
        ]);
        $service->save([
            'id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug
        ]);
        
        $this->notification()->notify([
            'title'   => 'Category Updated Successfully.',
            'icon'    => 'success',
            'timeout' => 2000,
            'dense'   => true
        ]);
        $this->cardModal = false;
    }

    public function delete(CategoryService $service, Category $category_id)
    {
        $service->delete($category_id);
        $this->cardModal = false;
        $this->notification()->notify([
            'title'   => 'Category deleted Successfully.',
            'icon'    => 'success',
            'timeout' => 2000,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.categories');
    }
}
