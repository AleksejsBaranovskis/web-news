<?php

namespace App\Models;

class Article
{
    private string $title;
    private string $author;
    private string $description;
    private string $url;
    private string $urlToImage;
    private ?int $id;

    public function __construct(string $title, string $author, string $description, string $url, string $urlToImage, ?int $id = null)
    {
        $this->title = $title;
        $this->author = $author;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->id = $id;
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

    public function getId(): ?int
    {
        return $this->id;
    }
}