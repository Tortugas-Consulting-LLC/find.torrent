<?php

$app['feed.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\FeedController($app['feeds.repository']);
});

$app['search.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\SearchController($app['feeds.repository']);
});

$app['download.controller'] = $app->share(function() use ($app, $config) {
    return new \FindDotTorrent\Controller\DownloadController($app['guzzle.client'], $config['downloadPath']);
});
