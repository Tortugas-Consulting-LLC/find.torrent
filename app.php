<?php

$app = new Bullet\App();
$app->path('greet', function($request) use($app) {
    $app->param('slug', function($request, $name) use($app) {
        return "Hello, $name";
    });
});

$app->path('/', function($request) use($app) {
    return "Hello, world!";
});
