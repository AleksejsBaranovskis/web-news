<?php

test('Should return correct article data', function () {
    $article = new \App\Models\Article('Title', 'Me', 'Test article', 'https://test.com',
    'https://testIMG.com');

    expect($article->getTitle())->toEqual('Title');
    expect($article->getAuthor())->toEqual('Me');
    expect($article->getDescription())->toEqual('Test article');
    expect($article->getUrl())->toEqual('https://test.com');
    expect($article->getUrlToImage())->toEqual('https://testIMG.com');
});