<?php

$app['feed.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\FeedController($app['feeds.repository']);
});

$app['search.controller'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Controller\SearchController($app['feeds.repository']);
});
