<?php

namespace App\Models;

class Article
{
    private string $title;
    private string $author;
    private string $description;
    private string $url;
    private string $urlToImage;

    public function __construct(string $title, string $author, string $description, string $url, string $urlToImage)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }
}