<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['feed.factory'] = $app->share(function() {
    return new \FindDotTorrent\Feed\Factory();
});

$app['search.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\SearchController($app['feed.factory']);
});

$app->get('/api/search/{term}', 'search.controller:allAction');

$app->run();