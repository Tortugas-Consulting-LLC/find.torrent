<?php
require __DIR__ . '/vendor/autoload.php';

$app = new Bullet\App();
$app->path('greet', function($request) use($app) {
    $app->param('slug', function($request, $name) use($app) {
        return "Hello, $name";
    });
});

$app->path('/', function($request) use($app) {
    return "Hello, world!";
});

// Run the app! (takes $method, $url or Bullet\Request object)
echo $app->run(new Bullet\Request());
