<?php

namespace FindDotTorrent\Feed;

use FindDotTorrent\Client;
use FindDotTorrent\Translator;

/**
 * A feed handler for KickAss torrents
 */
class KickAss implements \FindDotTorrent\Feed
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param Client $client
     * @param Translator $translator
     */
    public function __construct(Client $client, Translator $translator)
    {
        $this->client = $client;
        $this->translator = $translator;
    }

    /**
     * Perform a search for a specific term
     *
     * @param string $term The search term
     * @return array An array of Item objects
     */
    public function search($term)
    {
        $url = sprintf(
            "http://kickass.to/usearch/%s/?rss=1",
            rawurlencode($term)
        );

        $content = $this->client->get($url);
        $items = $this->translator->translate($content);

        return array_map(function ($item) {
            return $item->setLabel($this->getLabel());
        }, $items);
    }

    /**
     * Retrieve the label associated with this feed.
     *
     * @return string
     */
    public function getLabel()
    {
        return 'KickAss';
    }
}