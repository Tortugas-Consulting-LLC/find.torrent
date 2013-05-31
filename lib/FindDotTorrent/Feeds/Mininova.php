<?php

namespace FindDotTorrent\Feeds;

class Mininova extends BaseFeed implements IFeed
{
    protected $url = 'http://mininova.org';
    protected $base_search_url = 'http://mininova.org/rss/';

    public function getUrl()
    {
        return $this->url;
    }

    public function makeSearchUrl($term)
    {
        return $this->base_search_url . urlencode($term);
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
