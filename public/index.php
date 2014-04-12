<?php

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../app/config/config.php';

$app = new Silex\Application();

// Services
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array('db.options' => $config['db'])
);

// Supporting Classes
$app['feed.factory'] = $app->share(function() {
    return new \FindDotTorrent\Feed\Factory();
});

$app['feeds.repository'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Repository\Feeds($app['db'], $app['feed.factory']);
});

// Controllers
$app['feed.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\FeedController($app['feeds.repository']);
});

$app['search.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\SearchController($app['feeds.repository']);
});

$app->get('/api/feeds/', 'feed.controller:all');

$app->get('/api/search/{term}', 'search.controller:all');
$app->get('/api/search/{feed}/{term}', 'search.controller:one');

$app->run();