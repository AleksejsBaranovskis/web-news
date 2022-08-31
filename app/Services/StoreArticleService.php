<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\DatabaseArticleRepository;

class StoreArticleService
{
    private DatabaseArticleRepository $databaseArticleRepository;

    public function __construct(DatabaseArticleRepository $databaseArticleRepository)
    {

        $this->databaseArticleRepository = $databaseArticleRepository;
    }

    public function execute(StoreArticleServiceRequest $request): void
    {
        $article = new Article(
            $request->getTitle(),
            $request->getAuthor(),
            $request->getDescription(),
            $request->getUrl(),
            $request->getUrlToImage()
        );
        $this->databaseArticleRepository->save($article);
    }
}