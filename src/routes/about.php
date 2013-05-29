<?php
$app->path('about', function($request) use($app) {
    $data = array(
        'service' => 'find.torrent',
        'about'   => 'The find.torrent service is an open source project from Tortugas Consulting, LLC. It is distributed with the MIT license.',
        'version' => '0.0.1',
    );

    $hal = new \Nocarrier\Hal('/about/', $data);

    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('self', '/about/');
    $hal->addLink('ft:home', '/');

    return $hal;
});
