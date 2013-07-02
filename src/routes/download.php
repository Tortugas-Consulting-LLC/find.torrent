<?php
$app->path('/download', function($request) use($app) {
    $app->put(function($request) use ($app) {
       $target = $request->get('target');
       \FindDotTorrent\Feeds\Fetch::fetchTorrent($target);
    });
});
