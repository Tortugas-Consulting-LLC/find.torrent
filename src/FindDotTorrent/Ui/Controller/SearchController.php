<?php

namespace FindDotTorrent\Ui\Controller;

use FindDotTorrent\Repository\Feeds;
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
     * @var Feeds
     */
    protected $repo;

    /**
     * @param Feeds $repo
     */
    public function __construct(Feeds $repo)
    {
        $this->repo = $repo;
    }

    /**
     * This method allows searching for a given term across all enabled feeds.
     *
     * @param string $term
     * @return JsonResponse
     */
    public function all($term)
    {
        $feeds = $this->repo->getEnabled();

        $items = array_reduce($feeds, function ($items, $feed) use ($term) {
            return array_merge($items, $feed->search($term));
        }, array());

        return new JsonResponse($items);
    }

    /**
     * This method allows searching for a given term within the specified feed
     *
     * @param string $feed
     * @param string $term
     * @return JsonResponse
     */
    public function one($feed, $term)
    {
        $feed = $this->repo->get($feed);

        if (false === $feed) {
            return new JsonResponse(array('error' => 'The requested feed does not exist'), 400);
        }

        return new JsonResponse($feed->search($term));

    }
}