<?php

namespace FindDotTorrent\Feeds;

class KickAssTorrents implements IFeed
{
    protected $base_url = 'http://kat.ph/usearch/%s/?rss=1';

    public function getUrl($term)
    {
        return sprintf($this->base_url, urlencode($term));
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
