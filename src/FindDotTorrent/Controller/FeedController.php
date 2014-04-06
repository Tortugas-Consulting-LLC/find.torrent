<?php

namespace FindDotTorrent\Controller;

use FindDotTorrent\Repository\Feeds;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Feed Controller
 *
 * The feed controller is responsible for fetching and updating feed statuses
 */
class FeedController
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
     * A simple action to retrieve all the feeds available for this site.
     *
     * @return JsonResponse
     */
    public function all()
    {
        $feeds = $this->repo->all();

        return new JsonResponse($feeds);
    }

    /**
     * Enable / disable an individual feed
     *
     * @param string $label The feed to set the status on
     * @param bool $enabled
     * @return JsonResponse
     */
    public function setStatus($label, $enabled)
    {
        $feed = $this->repo->get($label);

        if (false === $feed) {
            return new JsonResponse(array('error' => 'The requested feed does not exist'), 400);
        }

        $this->repo->setStatus($feed, $enabled);

        return new JsonResponse();
    }
}