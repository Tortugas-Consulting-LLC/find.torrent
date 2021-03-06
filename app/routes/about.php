<?php
use Nocarrier\Hal;

$app->path('about', function($request) use($app) {
    $app->filter('authenticate');

    $data = array(
        'service' => 'find.torrent',
        'about'   => 'The find.torrent service is an open source project from Tortugas Consulting, LLC. It is distributed with the MIT license.',
        'version' => '0.0.1',
    );

    $hal = new Hal('/about/', $data);

    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('ft:home', '/');

    return $hal;
});
