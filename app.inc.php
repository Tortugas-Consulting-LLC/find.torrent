<?php

$app = new Bullet\App(parse_ini_file(__DIR__ . '/config.ini'));

$app->path('greet', function($request) use($app) {
    $app->param('slug', function($request, $name) use($app) {
        return "Hello, $name";
    });
});

$app->path('/', function($request) use($app) {
    return $app->offsetGet('welcome_msg');
});
