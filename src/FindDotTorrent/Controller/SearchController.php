<?php

namespace FindDotTorrent\Controller;

use FindDotTorrent\Feed\Factory;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Search Controller
 *
 * The search controller is responsible for fetching search requests from the
 * requested feed(s) based off the search term provided.
 */
class SearchController
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * This method allows searching for a given term across all enabled feeds.
     *
     * @param string $term
     * @return JsonResponse
     */
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