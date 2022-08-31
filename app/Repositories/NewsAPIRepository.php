<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticlesCollection;

class NewsAPIRepository implements NewsRepository
{
    public function getAll(string $q): ArticlesCollection
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => $_ENV['NEWS_API']
        ]);

        $response = $client->get('/v2/top-headlines', [
            'query' => [
                'country' => 'lv',
                'category' => $q,
                'apiKey' => $_ENV['NEWS_API_KEY']
            ]
        ]);

        $news = json_decode($response->getBody());

        $articles = [];
        foreach ($news->articles as $article) {
            if ($article->urlToImage) {
                $articles[] = new Article(
                    (string)$article->title,
                    (string)$article->author,
                    (string)$article->description,
                    (string)$article->url,
                    (string)$article->urlToImage
                );
            }
        }
        return new ArticlesCollection($articles);
    }

    public function save(Article $article): void
    {
        // TODO: Implement save() method.
    }
}