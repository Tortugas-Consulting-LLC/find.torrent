<?php

$dir_config = __DIR__ . '/config';
$dir_routes = __DIR__ . '/routes';

$config = parse_ini_file($dir_config .'/config.ini');

$app = new Bullet\App($config);

foreach (glob($dir_routes . "/*.php") as $filename) {
    require $filename;
}

$app->registerResponseHandler(
    function($response) {
        return $response->content() instanceof \NoCarrier\Hal;
    },
    function($response) use($app) {
        if ('xml' === strtolower($app->offsetGet('response_format'))) {
            $response->content($response->content()->asXml());
            $response->contentType('application/hal+xml');
        } else {
            $response->content($response->content()->asJson());
            $response->contentType('application/hal+json');
        }
    }
);
