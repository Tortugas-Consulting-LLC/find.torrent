<?php

namespace FindDotTorrent\Feed;

use FindDotTorrent\Client;
use FindDotTorrent\Translator;

class Factory
{
    /**
     * @param string $feed The name of the feed to build
     * @return Feed
     * @throws InvalidArgumentException
     */
    public function build($feed)
    {
        $client = new Client\GuzzleAdapter();
        $translator = new Translator\Rss();

        switch ($feed) {
          case 'Mininova':
            return new Mininova($client, $translator);
            break;
          case 'KickAss':
            return new KickAss($client, $translator);
            break;
          default:
            throw new \InvalidArgumentException("The requested feed type is not supported.");
            break;
        }
    }
}