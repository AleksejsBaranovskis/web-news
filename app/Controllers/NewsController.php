<?php

namespace App\Controllers;

use App\Repositories\DatabaseArticleRepository;
use App\Services\NewsService;
use App\Services\StoreArticleService;
use App\Services\StoreArticleServiceRequest;
use App\View;

class NewsController
{
    private NewsService $newsService;
    private StoreArticleService $storeArticleService;
    private DatabaseArticleRepository $databaseArticleRepository;

    public function __construct(
        NewsService               $newsService,
        StoreArticleService       $storeArticleService,
        DatabaseArticleRepository $databaseArticleRepository
    )
    {
        $this->newsService = $newsService;
        $this->storeArticleService = $storeArticleService;
        $this->databaseArticleRepository = $databaseArticleRepository;
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

    public function store(): void
    {
        $this->storeArticleService->execute(
            new StoreArticleServiceRequest(
                $_POST['title'],
                $_POST['author'],
                $_POST['image'],
                $_POST['description'],
                $_POST['url']
            )
        );
        header('Location: /news');
    }

    public function created(): View
    {
        return new View ('created.twig', ['news' => $this->databaseArticleRepository->getAll()->getArticles()]);
    }
}