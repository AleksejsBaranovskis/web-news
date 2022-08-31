<?php

namespace App\Services;

class StoreArticleServiceRequest
{
    private string $title;
    private string $author;
    private string $urlToImage;
    private string $description;
    private string $url;

    public function __construct(string $title, string $author, string $urlToImage, string $description, string $url)
    {
        $this->title = $title;
        $this->author = $author;
        $this->urlToImage = $urlToImage;
        $this->description = $description;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}