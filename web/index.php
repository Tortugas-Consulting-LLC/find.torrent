<?php

require __DIR__ . "/../vendor/autoload.php";

// Capture request immediately to preserve raw input from php://input
$request = new \Bullet\Request();

$app = new FindDotTorrent\App();

$app->on("authenticate", function (\Bullet\Request $request, \Bullet\Response $response) use ($app) {
    if (true !== ($authentication_result = $app->requestIsAuthenticated($request))) {
        echo $app->response(401, $authentication_result);
        exit;
    }
});

$app->on("Exception", function (\Bullet\Request $request, \Bullet\Response $response, \Exception $exception) {
    print $exception->getMessage();
});

echo $app->run($request);
