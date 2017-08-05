<?php
use FindDotTorrent\Feeds;

$app->path('/download', function ($request) use ($app) {
    $app->filter('authenticate');

    $app->put(function ($request) use ($app) {
        /** @var \Bullet\Request $request */
        $target = $request->get('target');
        $result = Feeds\Fetch::fetchTorrent($target, $app['download_path']);

        if (false == $result) {
            return 500;
        }

        $hal = new \Nocarrier\Hal('/download', array('path' => $result));

        return $hal;
    });
});
