<?php

use Illuminate\Http\Request;
use App\Models\ArticleResource;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\Categories;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Admin\Departments;
use App\Http\Livewire\Admin\Article\ArticleForm;
use App\Http\Livewire\Admin\Article\ArticleList;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('departments', Departments::class)->name('admin.departments.index');
Route::get('categories', Categories::class)->name('admin.categories.index');
Route::get('articles', ArticleList::class)->name('admin.articles.index');
Route::get('article-form/{article?}', ArticleForm::class)->name('admin.articles.form');
Route::post('articles/upload', function(Request $req) {    
    $file = $req->file('file');
    $url = $file->store('articles','public');
    return Storage::url($url);
})->name('admin.articles.upload');