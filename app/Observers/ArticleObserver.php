<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function created(Article $article)
    {
        //
    }

    /**
     * Handle the Article "updated" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    public function deleting(Article $article)
    {
        if (Storage::exists($article->featured_image)) {
            Storage::delete($article->featured_image);
        }

        foreach ($article->resources as $resource) {
            if ($resource->file) {
                Storage::delete($resource->file);
            }
            $resource->delete();
        }
    }

    /**
     * Handle the Article "restored" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}
