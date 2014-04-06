<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array(
        'db.options' => array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../app/db.sqlite3'
        )
    )
);

$app['feed.factory'] = $app->share(function() {
    return new \FindDotTorrent\Feed\Factory();
});

$app['feeds.repository'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Repository\Feeds($app['db'], $app['feed.factory']);
});

$app['search.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\SearchController($app['feeds.repository']);
});

$app->get('/api/search/{term}', 'search.controller:all');
$app->get('/api/search/{feed}/{term}', 'search.controller:one');

$app->run();