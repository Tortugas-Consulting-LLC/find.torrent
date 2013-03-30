<?php
$app->path('/', function($request) use($app) {

    $data = array('welcome' => $app->offsetGet('welcome_msg'));

    $hal = new \Nocarrier\Hal('/', $data);

    $hal->addLink('self', '/');
    $hal->addLink('about', '/about/');
    $hal->addLink('feeds', '/feeds/');
    $hal->addLink('search', '/feeds/search/{?term}', array('templated' => true));

    return $hal;
});
