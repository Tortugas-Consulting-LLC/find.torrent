<?php
$app->path('/about/', function($request) use($app) {
    return array (
        '_links' => array (
            'self' => array ( 'href' => '/about/'),
            'home' => array ( 'href' => '/'),
        ),
        'service' => 'find.torrent',
        'about'   => 'The find.torrent service is an open source project from Tortugas Consulting, LLC. It is distributed with the MIT license.',
        'version' => '0.0.1',
    );
});
