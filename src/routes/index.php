<?php
$app->path('/', function($request) use($app) {
    return array(
        '_links' => array (
            'self'    => array ( 'href' => '/'),
            'about'   => array ( 'href' => '/about/'),
            'feeds'   => array ( 'href' => '/feeds/'),
            'search'  => array ( 'href' => '/feeds/search/{?term}', 'templated' => true)
        ),
        'welcome' => $app->offsetGet('welcome_msg')
    );
});
