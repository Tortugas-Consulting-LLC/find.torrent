<?php

namespace FindDotTorrent\Feed;

use FindDotTorrent\Client;
use FindDotTorrent\Translator;

/**
 * A feed handler for KickAss torrents
 */
class KickAss implements \FindDotTorrent\Feed, \JsonSerializable
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
     * @var boolean
     */
    protected $enabled;

    /**
     * @param Client $client
     * @param Translator $translator
     */
    public function __construct(Client $client, Translator $translator, $enabled)
    {
        $this->client = $client;
        $this->translator = $translator;
        $this->enabled = (bool) $enabled;
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

    /**
     * Return an array to be used when serializing / encoding this object as JSON
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            'label' => $this->getLabel(),
            'enabled' => $this->enabled
        );
    }
}