<?php

namespace App\Observers;

use App\Models\ArticleResource;
use Illuminate\Support\Facades\Storage;

class ArticleResourceObserver
{
    /**
     * Handle the ArticleResource "created" event.
     *
     * @param  \App\Models\ArticleResource  $articleResource
     * @return void
     */
    public function created(ArticleResource $articleResource)
    {
        //
    }

    /**
     * Handle the ArticleResource "updated" event.
     *
     * @param  \App\Models\ArticleResource  $articleResource
     * @return void
     */
    public function updated(ArticleResource $articleResource)
    {
        //
    }

    /**
     * Handle the ArticleResource "deleted" event.
     *
     * @param  \App\Models\ArticleResource  $articleResource
     * @return void
     */
    public function deleted(ArticleResource $articleResource)
    {
        if ($articleResource->file) {
            Storage::delete($articleResource->file);
        }
    }

    /**
     * Handle the ArticleResource "restored" event.
     *
     * @param  \App\Models\ArticleResource  $articleResource
     * @return void
     */
    public function restored(ArticleResource $articleResource)
    {
        //
    }

    /**
     * Handle the ArticleResource "force deleted" event.
     *
     * @param  \App\Models\ArticleResource  $articleResource
     * @return void
     */
    public function forceDeleted(ArticleResource $articleResource)
    {
        //
    }
}
