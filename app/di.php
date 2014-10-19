<?php

$app['guzzle.client'] = $app->share(function() {
    return new \FindDotTorrent\Infrastructure\GuzzleClient();
});

$app['feed.factory'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Feed\Factory($app['guzzle.client']);
});

$app['feeds.repository'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Infrastructure\Persistence\PdoFeedRepository($app['db'], $app['feed.factory']);
});
