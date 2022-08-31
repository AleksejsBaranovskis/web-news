<?php

namespace App\Console;

use App\Models\Article;
use App\Services\NewsService;

class ArticlesCommand
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function execute(string $category): int
    {
        /** @var Article[] $articles */
        $articles = $this->newsService->getAll($category)->getArticles();

        foreach ($articles as $article) {
            echo $article->getTitle() . PHP_EOL;
        }
        return 1;
    }
}