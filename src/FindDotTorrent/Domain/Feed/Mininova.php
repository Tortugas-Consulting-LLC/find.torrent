<?php

namespace FindDotTorrent\Domain\Feed;

use FindDotTorrent\Domain;
use FindDotTorrent\Translator;

/**
 * A feed handler for Mininova torrents
 */
class Mininova implements \FindDotTorrent\Feed, \JsonSerializable
{
    /**
     * @var Domain\Client
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
     * @param Domain\Client $client
     * @param Translator $translator
     * @param boolean $enabled
     */
    public function __construct(Domain\Client $client, Translator $translator, $enabled)
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
            "http://mininova.org/rss/%s",
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
        return 'Mininova';
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
