<?php

namespace App\Services;

use App\Models\ArticlesCollection;
use App\Repositories\NewsRepository;

class NewsService
{
    private NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    public function getAll(string $q): ArticlesCollection
    {
       return $this->newsRepository->getAll($q);
    }
}