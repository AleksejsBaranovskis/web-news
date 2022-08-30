<?php

namespace App\Controllers;

use App\Services\NewsService;
use App\View;

class NewsController
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function show(): View
    {
        $q = $_GET['category'] ?? 'business';
        return new View ('news.twig', ['news' => $this->newsService->getAll($q)->getArticles()]);
    }

    public function create(): View
    {
        return new View ('add-article.twig');
    }
}