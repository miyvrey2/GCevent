<?php

namespace App\Http\ViewComposers;

use App\Article;
use Illuminate\View\View;
use App\Repositories\ArticleRepository;

class ArticleComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('recent_articles', Article::recentArticles());
    }
}