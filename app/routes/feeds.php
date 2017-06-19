<?php
use FindDotTorrent\Feeds;

$app->path('feeds', function($request) use($app) {
    $app->filter('authenticate');

    $make_feed_hal = function($feed) use($app) {
        /** @var Feeds\BaseFeed $feed */
        $feed_hal = new \Nocarrier\Hal('/feeds/' . $feed->getIdentifier(), array(
            "name"    => $feed->getName(),
            "url"     => $feed->getUrl(),
            "enabled" => $feed->getEnabled()
        ));
        $app['HalHandler']->addMyCurie($feed_hal);

        return $feed_hal;
    };

    // When specifying a particular feed handle GET and PUT
    $app->param('slug', function($request, $feed_id) use ($app, $make_feed_hal) {
        $feed = $app['FeedHandler']->find($feed_id);
        if (false === $feed) {
            return $app->response(404, "Feed {$feed_id} not found.");
        }

        $app->put(function($request) use($app, $feed, $make_feed_hal) {
            /** @var Feeds\BaseFeed $feed */
            /** @var \Bullet\Request $request */
            $feed->setEnabled($request->get("enabled"));
            $app['FeedHandler']->persist($feed);
            return $make_feed_hal($feed);
        });

        $app->get(function($request) use($app, $feed, $make_feed_hal) {
            return $make_feed_hal($feed);
        });
    });

    // Begin response for straight calls to /feeds/
    $hal = new \Nocarrier\Hal('/feeds/');
    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('ft:home', '/');
    $hal->addLink('ft:search', '/search/{?term}', array('templated' => true));

    foreach($app['FeedHandler']->findAll() as $feed) {
        $hal->addResource('ft:feed', $make_feed_hal($feed));
    }

    return $hal;
});
