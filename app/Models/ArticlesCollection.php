<?php

namespace App\Models;

class ArticlesCollection
{
    private array $articles;

    public function __construct(array $articles)
    {
        foreach ($articles as $article) {
            $this->add($article);
        }
        $this->articles = $articles;
    }

    public function add(Article $article): void
    {
        $this->articles[] = $article;
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}