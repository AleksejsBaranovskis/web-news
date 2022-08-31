<?php

require_once 'vendor/autoload.php';

$env = Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();

$container = new DI\Container();
$container->set(\App\Repositories\NewsRepository::class, \DI\create(\App\Repositories\NewsAPIRepository::class));

$commands = [
    'articles' => \App\Console\ArticlesCommand::class
];

$selected = $argv[1];

$container->get($commands[$selected])->execute($argv[2]);