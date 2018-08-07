<?php
namespace App\Repositories;

use App\Article;

class ArticleRepository
{
    /**
     * Get 5 latest recent articles
     *
     * @return Collection
     */
    public function recentArticles()
    {
        $recent_articles = Article::published()->orderBy('published_at', 'DESC')->limit(5)->get();

        return $recent_articles;
    }
}