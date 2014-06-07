<?php

$app['guzzle.client'] = $app->share(function() {
    return new \FindDotTorrent\Client\GuzzleAdapter();
});

$app['feed.factory'] = $app->share(function() {
    return new \FindDotTorrent\Feed\Factory();
});

$app['feeds.repository'] = $app->share(function() use ($app) {
    return new \FindDotTorrent\Repository\Feeds($app['db'], $app['feed.factory']);
});
