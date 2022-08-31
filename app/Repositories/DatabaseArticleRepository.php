<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticlesCollection;

class DatabaseArticleRepository implements NewsRepository
{

    public function getAll(string $q = null): ArticlesCollection
    {
        $connectionParams = [
            'dbname' => 'web_news',
            'user' => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        $queryBuilder = $conn->createQueryBuilder();

        $articlesQuery = $queryBuilder
            ->select('*')
            ->from('news_articles')
            ->executeQuery()
            ->fetchAllAssociative();

        $articles = [];
        foreach ($articlesQuery as $userArticle) {
            $articles [] = new Article(
                (string)$userArticle['title'],
                (string)$userArticle['author'],
                (string)$userArticle['description'],
                (string)$userArticle['url'],
                (string)$userArticle['image_url'],
                $userArticle['id']
            );
        }
        return new ArticlesCollection($articles);
    }

    public function save(Article $article): void
    {
        $connectionParams = [
            'dbname' => 'web_news',
            'user' => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

        $conn->insert('news_articles', [
            'title' => $article->getTitle(),
            'author' => $article->getAuthor(),
            'description' => $article->getDescription(),
            'url' => $article->getUrl(),
            'image_url' => $article->getUrlToImage()
        ]);
    }
}