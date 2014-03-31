<?php

require __DIR__ . "/../vendor/autoload.php";

$app = new FindDotTorrent\App();

$app->on("authenticate", function($request, $response) use ($app) {
    if (true !== ($authentication_result = $app->requestIsAuthenticated($request))) {
        echo $app->response(401, $authentication_result);
        exit;
    }
});

$app->on("Exception", function($request, $response, $exception) {
    print $exception->getMessage();
});

echo $app->run(new Bullet\Request());
