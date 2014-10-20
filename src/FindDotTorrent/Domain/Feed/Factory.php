<?php

namespace FindDotTorrent\Domain\Feed;

use FindDotTorrent\Domain;

/**
 * This factory constructs feeds, injecting in all their needed dependencies
 */
class Factory
{
    /**
     * @var Domain\Client
     */
    protected $client;

    /**
     * @param Domain\Client $client
     */
    public function __construct(Domain\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Build and return the requested feed type
     *
     * @param string $feed The name of the feed to build
     * @return Feed
     * @throws InvalidArgumentException
     */
    public function build($feed)
    {
        $translator = new Domain\Translator\Rss();

        switch ($feed['label']) {
          case 'Mininova':
            return new Mininova($this->client, $translator, $feed['enabled']);
            break;
          case 'KickAss':
            return new KickAss($this->client, $translator, $feed['enabled']);
            break;
          default:
            throw new \InvalidArgumentException("The requested feed type is not supported.");
            break;
        }
    }
}