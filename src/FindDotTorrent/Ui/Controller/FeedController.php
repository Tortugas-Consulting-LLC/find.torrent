<?php

namespace FindDotTorrent\Ui\Controller;

use FindDotTorrent\Domain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feed Controller
 *
 * The feed controller is responsible for fetching and updating feed statuses
 */
class FeedController
{
    /**
     * @var Domain\FeedRepository
     */
    protected $repo;

    /**
     * @param Domain\FeedRepository $repo
     */
    public function __construct(Domain\FeedRepository $repo)
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
     * @param Request $request
     * @param string $feed The feed to set the status on
     * @return JsonResponse
     */
    public function setStatus(Request $request, $feed)
    {
        $enabled = $request->get('enabled');
        $feed = $this->repo->get($feed);

        if (false === $feed) {
            return new JsonResponse(array('error' => 'The requested feed does not exist'), 400);
        }

        $this->repo->setStatus($feed, $enabled);

        return new JsonResponse(null, 204);
    }
}