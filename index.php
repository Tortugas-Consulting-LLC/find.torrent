<?php

require __DIR__ . '/vendor/autoload.php';

$app = new FindDotTorrent\App();

$app->on('Exception', function($request, $response, $exception) {
    print $exception->getMessage();
});

echo $app->run(new Bullet\Request());
