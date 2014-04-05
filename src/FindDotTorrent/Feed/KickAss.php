<?php

namespace FindDotTorrent\Feed;

use FindDotTorrent\Client;
use FindDotTorrent\Translator;

class KickAss implements Feed
{
    protected $client;
    protected $translator;

    public function __construct(Client $client, Translator $translator)
    {
        $this->client = $client;
        $this->translator = $translator;
    }

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

    public function getLabel()
    {
        return 'KickAss';
    }
}