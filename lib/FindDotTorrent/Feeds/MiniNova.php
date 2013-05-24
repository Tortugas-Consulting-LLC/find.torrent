<?php

namespace FindDotTorrent\Feeds;

class MiniNova implements IFeed
{
    protected $base_url = 'http://mininova.org/rss/';

    public function getUrl($term)
    {
        return $this->base_url . urlencode($term);
    }

    public function fetchResults($response)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($response);

        $xmlPath = new \DOMXPath($dom);
        $itemPath = $xmlPath->query('*/item');

        $results = array();
        foreach($itemPath as $item) {
            $result = new SearchResult();
            $result->setId($item->getElementsByTagName('guid')->item(0)->nodeValue)
                   ->setTitle($item->getElementsByTagName('title')->item(0)->nodeValue)
                   ->setLink($item->getElementsByTagName('link')->item(0)->nodeValue);

            $results[] = $result;
        }

        return $results;
    }
}
