<?php
$app->path('/download', function($request) use($app) {
    $app->filter('authenticate');

    $app->put(function($request) use ($app) {
       $target = $request->get('target');
       $result = \FindDotTorrent\Feeds\Fetch::fetchTorrent($target, $app['download_path']);

       if ( false == $result ) {
           return 500;
       }

       $hal = new \Nocarrier\Hal('/download', array('path' => $result));

       return $hal;
    });
});
