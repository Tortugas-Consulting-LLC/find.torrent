<?php

namespace FindDotTorrent\Controller;

use FindDotTorrent\Feed\Factory;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController
{
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function allAction($term)
    {
        $feeds = array();
        $feeds[] = $this->factory->build('KickAss');
        $feeds[] = $this->factory->build('Mininova');

        $items = array();
        foreach ($feeds as $feed) {
            $items = array_merge($items, $feed->search($term));
        }

        return new JsonResponse($items);
    }
}