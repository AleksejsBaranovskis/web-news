<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticlesCollection;

interface NewsRepository
{
    public function getAll(string $q): ArticlesCollection;

    public function save(Article $article): void;
}